<?php

namespace app\Traits;
use Random\RandomException;

trait HasApiTokens{
    protected string $api_token;
    protected string $duration;

    /**
     * @throws RandomException
     */
    public function createApiToken (int $userId): string
    {
        $query = "INSERT INTO user_api_tokens (user_id, token, expires_at,created_at) 
                  VALUES(:userId, :token, :expiresAt, NOW())";
        $this->api_token = bin2hex(random_bytes(40));
        $this->duration = date('Y-m-d H:i:s', strtotime('+'.$_ENV['API_TOKEN_EXPIRATION_DAY'].' day'));
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ":userId" => $userId,
            ":token" => $this->api_token,
            ":expiresAt" => $this->duration,
        ]);
        return $this->api_token;
    }
}