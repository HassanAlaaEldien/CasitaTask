<?php

namespace App\Http\Responses;


interface ResponsesInterface
{

    /**
     * Respond with a validation error.
     *
     * @param $errors
     *
     * @return mixed
     */
    public function respondWithValidationError($errors);

    /**
     * Respond with a not found error.
     *
     * @param string $message
     *
     * @return mixed
     */
    public function respondNotFound($message = 'Not Found!');

    /**
     * Respond with an internal error.
     *
     * @param string $message
     *
     * @return mixed
     */
    public function respondInternalError($message = 'Internal Server Error!');

    /**
     * Respond with an authorization error.
     *
     * @param string $message
     *
     * @return mixed
     */
    public function respondAuthorizationError($message = 'You don\'t have the rights to access this resource.');

    /**
     * Respond with an authentication error.
     *
     * @param string $message
     *
     * @return mixed
     */
    public function respondAuthenticationError($message = 'Forbidden!');

    /**
     * Respond with generic error.
     *
     * @param $message
     *
     * @return mixed
     */
    public function respondWithError($message);

    /**
     * Respond with data.
     *
     * @param $data
     *
     * @return mixed
     */
    public function respond($data);
}
