<?php

namespace App\Support;

use Carbon\Carbon;
use Illuminate\Support\Arr;

class OTP
{
    /**
     * The code of valid status.
     */
    const VALID_STATUS = 'VALID';

    /**
     * The code of invalid status.
     */
    const INVALID_STATUS = 'INVALID';

    /**
     * The code of expired status.
     */
    const EXPIRED_STATUS = 'EXPIRED';

    /**
     * The data of the given OTP.
     */
    protected array $data = [];

    /**
     * The encrypted token of the otp data.
     */
    protected string $token;

    /**
     * The status of the validated OTP.
     */
    protected string $status;

    /**
     * Set the data of the OTP that should be encrypted.
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Generate the OTP and encrypt it with data for 10 minutes.
     */
    public function generate(mixed $otp = null): static
    {
        // Generate the OTP.
        $this->data['_OTP_CODE_'] = $otp ?: rand(1000, 9999);

        // Set the expiration date for the OTP.
        $this->data['_OTP_EXPIRE_DATE_'] = now()->addMinutes(10)->toDateTimeString();

        // Encrypt the data and OTP.
        $this->token = app('encrypter')->encrypt($this->data);

        $this->status = self::VALID_STATUS;

        return $this;
    }

    /**
     * Get the generated OTP.
     */
    public function getOtp(): mixed
    {
        return data_get($this->data, '_OTP_CODE_');
    }

    /**
     * Get the generated OTP.
     */
    public function getExpirationDate(): ?string
    {
        return data_get($this->data, '_OTP_EXPIRE_DATE_');
    }

    /**
     * Get the token of the encrypted data.
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Get the data of the OTP.
     */
    public function getData(): array
    {
        return Arr::except($this->data, ['_OTP_CODE_', '_OTP_EXPIRE_DATE_']);
    }

    /**
     * Merge the given data with the OTP's data and refresh the token.
     */
    public function mergeData(array $data): static
    {
        $this->data = [...$this->data, ...$data];

        $this->generate($this->getOtp());

        return $this;
    }

    /**
     * Determine whither the OTP is expired.
     */
    public function expired(): bool
    {
        return Carbon::parse($this->getExpirationDate())->isPast();
    }

    /**
     * Validate the given token with the given OTP.
     */
    public function validate(string $token, string|int $otp): static
    {
        $this->decryptToken($token);

        if ($this->getOtp() != $otp) {
            $this->status = self::INVALID_STATUS;

            return $this;
        }

        return $this;
    }

    public function decryptToken(string $token = ''): static
    {
        try {
            $this->data = app('encrypter')->decrypt($token);
            if ($this->expired()) {
                $this->status = self::EXPIRED_STATUS;

                return $this;
            }

            $this->status = self::VALID_STATUS;
        } catch (\Exception $exception) {
            $this->status = self::INVALID_STATUS;
        }

        return $this;
    }

    /**
     * Check if the OTP is valid.
     */
    public function isValid(): bool
    {
        return $this->status == self::VALID_STATUS;
    }

    /**
     * Check if the OTP is invalid.
     */
    public function isInvalid(): bool
    {
        return ! $this->isValid();
    }

    /**
     * Get the OTP status code.
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}
