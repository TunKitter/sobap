<?php
interface AuthMethod
{
    public function check(Request $request): array;
    public function login(Request $request): bool;
    public function logout(Request $request): bool;
}