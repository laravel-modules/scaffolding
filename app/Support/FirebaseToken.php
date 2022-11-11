<?php

namespace App\Support;

use Illuminate\Support\Facades\Config;
use Illuminate\Auth\AuthenticationException;
use Kreait\Firebase\JWT\Contract\Token;
use Kreait\Firebase\JWT\IdTokenVerifier;

class FirebaseToken
{
    /**
     * @var string
     */
    protected string $verifierId;

    /**
     * Set the verifier id.
     *
     * @param string $token
     * @return $this
     */
    public function accessToken(string $token): static
    {
        $this->verifierId = $token;

        return $this;
    }

    /**
     * Get the valid phone number from access token.
     *
     * @throws AuthenticationException
     * @return string|null
     */
    public function getPhoneNumber(): string|null
    {
        return data_get($this->getVerifier()->payload(), 'phone_number');
    }

    /**
     * Get the valid phone number from access token.
     *
     * @throws AuthenticationException
     * @return string|null
     */
    public function getEmail(): string|null
    {
        return data_get($this->getVerifier()->payload(), 'email');
    }

    /**
     * Get the valid phone number from access token.
     *
     * @throws AuthenticationException
     * @return string|null
     */
    public function getName(): string|null
    {
        return data_get($this->getVerifier()->payload(), 'name');
    }

    /**
     * Get the valid phone number from access token.
     *
     * @throws AuthenticationException
     * @return string|null
     */
    public function getFirebaseId(): string|null
    {
        return data_get($this->getVerifier()->payload(), 'user_id');
    }

    /**
     * @throws \Illuminate\Auth\AuthenticationException
     * @return \Kreait\Firebase\JWT\Contract\Token
     */
    public function getVerifier(): Token
    {
        $projectId = Config::get('accounts.firebase_project_id');

        $verifier = IdTokenVerifier::createWithProjectId($projectId);

        try {
            return $verifier->verifyIdToken($this->verifierId);
        } catch (\Throwable $e) {
            throw new AuthenticationException('Invalid access token!');
        }
    }
}
