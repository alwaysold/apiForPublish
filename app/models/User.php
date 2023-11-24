<?php

class User extends Database
{

  private $pdo;

  public function __construct()
  {
    $this->pdo = $this->getConnection();
  }

  public function list($id)
  {
    try {
      $stm = $this->pdo->prepare("SELECT `id`, `name`, `email` FROM `users` WHERE `id` = ?");
      $stm->execute([$id]);

      if ($stm->rowCount() > 0) {
        return $stm->fetch(PDO::FETCH_ASSOC);
      } else {
        return false;
      }
    } catch (PDOException $err) {
      return false;
    }
  }

  public function dashboard($id)
  {
    try {
      $stm = $this->pdo->prepare("
      SELECT u.id, u.name, u.email, us.question_id, us.language_id, us.user_code, us.submission_time, us.is_correct 
      FROM users u 
      LEFT JOIN user_solutions us ON u.id = us.user_id 
      WHERE u.id = ?
    ");
      $stm->execute([$id]);

      if ($stm->rowCount() > 0) {
        // Fetch all rows returned by the query
        return $stm->fetchAll(PDO::FETCH_ASSOC);
      } else {
        return false;
      }
    } catch (PDOException $err) {
      return false;
    }
  }


  public function resetPassword($email, $otp, $newPassword)
  {
    try {
      // Check if the OTP exists and is not expired
      $currentTime = time();
      $stm = $this->pdo->prepare("SELECT * FROM otp_tokens WHERE email = ? AND otp = ? AND expiration_time >= ?");
      $stm->execute([$email, $otp, $currentTime]);

      if ($stm->rowCount() > 0) {
        // OTP is valid and not expired, proceed with password reset
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updateStm = $this->pdo->prepare("UPDATE users SET passwd = ? WHERE email = ?");
        $updateStm->execute([$hashedPassword, $email]);

        if ($updateStm->rowCount() > 0) {
          // Password reset successful
          return true;
        } else {
          return false;
        }
      } else {
        // OTP is invalid or expired, do nothing
        return false;
      }
    } catch (PDOException $err) {
      return false;
    }
  }

  public function storeOTP($email, $otp, $expirationTime)
  {
    try {
      // Check if the email already exists in the database
      $checkStmt = $this->pdo->prepare("SELECT COUNT(*) FROM otp_tokens WHERE email = ?");
      $checkStmt->execute([$email]);
      $rowCount = $checkStmt->fetchColumn();

      if ($rowCount > 0) {
        // If the email exists, update the existing record
        $updateStmt = $this->pdo->prepare("UPDATE otp_tokens SET otp = ?, expiration_time = ? WHERE email = ?");
        $updateStmt->execute([$otp, $expirationTime, $email]);
      } else {
        // If the email does not exist, insert a new row
        $insertStmt = $this->pdo->prepare("INSERT INTO otp_tokens (email, otp, expiration_time) VALUES (?, ?, ?)");
        $insertStmt->execute([$email, $otp, $expirationTime]);
      }

      return true;
    } catch (PDOException $err) {
      return false;
    }
  }



  public function verifyOTP($email, $otp)
  {
    try {
      // Check if the OTP exists and is not expired
      $currentTime = time();
      $stm = $this->pdo->prepare("SELECT * FROM otp_tokens WHERE email = ? AND otp = ? AND expiration_time >= ?");
      $stm->execute([$email, $otp, $currentTime]);

      if ($stm->rowCount() > 0) {
        // OTP is valid and not expired
        return true;
      } else {
        return false;
      }
    } catch (PDOException $err) {
      return false;
    }
  }

  public function create($data)
  {
    try {
      $stm = $this->pdo->prepare("INSERT INTO `users`(`name`, `email`, `passwd`) VALUES (?, ?, ?)");

      // var_dump($stm);

      $name = $data[0];
      $email = $data[1];
      $hashedPassword = password_hash($data[2], PASSWORD_DEFAULT);

      $stm->execute([$name, $email, $hashedPassword]);

      return true;
    } catch (PDOException $err) {
      return false;
    }
  }

  public function signIn($data)
  {
    try {
      $stm = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
      $stm->execute([$data[0]]);

      if ($stm->rowCount() > 0) {
        $user = $stm->fetch(PDO::FETCH_ASSOC);

        if (password_verify($data[1], $user['passwd'])) {
          return $user;
        } else {
          return false;
        }
      } else {
        return false;
      }
    } catch (PDOException $err) {
      return false;
    }
  }

  public function emailAlreadyExists($email)
  {
    try {
      $stm = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
      $stm->execute([$email]);

      if ($stm->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
    } catch (PDOException $err) {
      return false;
    }
  }

  public function update($data)
  {
    try {
      $stm = $this->pdo->prepare("UPDATE users SET name = ?, passwd = ? WHERE id = ?");
      $stm->execute([$data[0], password_hash($data[1], PASSWORD_DEFAULT), $data[2]]);

      if ($stm->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
    } catch (PDOException $err) {
      return false;
    }
  }

  public function isAdmin($id)
  {
    try {
      $stm = $this->pdo->prepare("SELECT * FROM users WHERE id = ? AND `admin` = 1");
      $stm->execute([$id]);

      if ($stm->rowCount() > 0) {
        return $stm->fetch(PDO::FETCH_ASSOC);
      } else {
        return false;
      }
    } catch (PDOException $err) {
      return false;
    }
  }

  // public function storeOTP($email, $otp, $expirationTime)
  // {
  //   try {
  //     $stm = $this->pdo->prepare("INSERT INTO otp_tokens (email, otp, expiration_time) VALUES (?, ?, ?)");
  //     $stm->execute([$email, $otp, $expirationTime]);

  //     return true;
  //   } catch (PDOException $err) {
  //     return false;
  //   }
  // }
}
