<?php
require_once __DIR__ . "/../_utils/io.php";

function validate_username(string $username): void
{
    if (strlen($username) < 3) {
        json_write(400, "Panjang minimum nama pengguna 3 aksara.");
    }
    if (strlen($username) > 15) {
        json_write(400, "Panjang maksimum nama pengguna 15 aksara.");
    }
    if (!preg_match("/^[\w+]+$/", $username)) {
        json_write(400, "Nama pengguna hanya boleh mengandungi nombor, abjad dan tanda garis bawah.");
    }
}

function validate_name(string $name): void
{
    if (strlen($name) < 1) {
        json_write(400, "Nama perlu diisi.");
    }
    if (strlen($name) > 80) {
        json_write(400, "Panjang maksimum nama 80 aksara.");
    }
    if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
        json_write(400, "Nama hanya boleh mengandungi abjad dan ruang.");
    }
    if (!preg_match("/[A-Za-z]/", $name)) {
        json_write(400, "Nama mesti mengandungi abjad.");
    }
}

function validate_password(string $password): void
{
    if (strlen($password) < 8) {
        json_write(400, "Panjang minimum kata laluan 8 aksara.");
    }
    if (strlen($password) > 12) {
        json_write(400, "Panjang maksimum kata laluan 12 aksara.");
    }
    if (!preg_match("/^[ -~]+$/", $password)) {
        json_write(400, "Kata laluan hanya boleh mengandungi abjad, nombor, ruang dan simbol.");
    }
    if (!preg_match("/[a-z]/", $password)) {
        json_write(400, "Kata laluan mesti mengandungi abjad huruf kecil.");
    }
    if (!preg_match("/[A-Z]/", $password)) {
        json_write(400, "Kata laluan mesti mengandungi abjad huruf besar.");
    }
    if (!preg_match("/\d/", $password)) {
        json_write(400, "Kata laluan mesti mengandungi nombor.");
    }
    if (!preg_match('/[!"#$%&\'()*+,-.\/:;<=>?@[\]^_`{|}~]/', $password)) {
        json_write(400, "Kata laluan mesti mengandungi simbol.");
    }
}
