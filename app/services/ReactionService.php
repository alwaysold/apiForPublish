<?php

class ReactionService extends Requests
{
  public function reactPost($id)
  {
    $method = $this->getMethod();
    var_dump($method);
    if ($method == 'get') {

      $result = [];
      $authorization = new Authorization();
      $jwt = new JWT();

      $reactionType = $id[0];
      $reactionPostId = $id[1];

      $token = $authorization->getAuthorization();
      if ($token) {
        $user = $jwt->validateJWT($token);
        if ($user) {
          $userId = $user->id;

          $reaction = new Reaction();
          $doneReaction = $reaction->reactPost($userId, $reactionType, $reactionPostId);

          if ($doneReaction) {
            $result['data'] = "reacted!";
          } else {
            $result['error'] = "Can't be reacted found.";
          }
        } else {
          $result['error'] = "Unauthorized, please verify your token.";
        }
      } else {
        $result['error'] = "Unauthorized, can't find token!";
      }
    } else {
      http_response_code(405);
      $result['error'] = "HTTP Method not allowed";
    }

    echo json_encode($result);
  }

  public function listPeopleIFollow()
  {
    $result = [];
    $authorization = new Authorization();
    $jwt = new JWT();

    $token = $authorization->getAuthorization();
    if ($token) {
      $user = $jwt->validateJWT($token);
      if ($user) {
        $userId = $user->id;

        $follower = new Follower();
        $following = $follower->listPeopleIFollow($userId);

        if ($following !== false) {
          $result['data'] = $following;
        } else {
          $result['error'] = "Not following anyone.";
        }
      } else {
        $result['error'] = "Unauthorized, please verify your token.";
      }
    } else {
      $result['error'] = "Unauthorized, can't find token!";
    }

    echo json_encode($result);
  }

  public function followById($id)
  {
    $result = [];
    $authorization = new Authorization();
    $jwt = new JWT();

    $token = $authorization->getAuthorization();
    if ($token) {
      $user = $jwt->validateJWT($token);
      if ($user) {
        $userId = $user->id;

        $follower = new Follower();
        $isFollowing = $follower->followById($userId, $id);

        if ($isFollowing) {
          $result['message'] = "Successfully followed user with ID $id.";
        } else {
          $result['error'] = "Failed to follow user with ID $id.";
        }
      } else {
        $result['error'] = "Unauthorized, please verify your token.";
      }
    } else {
      $result['error'] = "Unauthorized, can't find token!";
    }

    echo json_encode($result);
  }

  public function unfollowById($id)
  {
    $result = [];
    $authorization = new Authorization();
    $jwt = new JWT();

    $token = $authorization->getAuthorization();
    if ($token) {
      $user = $jwt->validateJWT($token);
      if ($user) {
        $userId = $user->id;

        $follower = new Follower();
        $isUnfollowed = $follower->unfollowById($userId, $id);

        if ($isUnfollowed) {
          $result['message'] = "Successfully unfollowed user with ID $id.";
        } else {
          $result['error'] = "Failed to unfollow user with ID $id.";
        }
      } else {
        $result['error'] = "Unauthorized, please verify your token.";
      }
    } else {
      $result['error'] = "Unauthorized, can't find token!";
    }

    echo json_encode($result);
  }
}
