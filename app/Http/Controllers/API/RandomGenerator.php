<?php


namespace App\Http\Controllers\API;


class RandomGenerator
{
    /**
     * Generate Random String of given $length (int) and by using $usedCharacters (string).
     * @param int $length
     * @param string $usedCharacters
     * @return string
    */
    public function generateRandomStringOfLength(int $length = 6, string $usedCharacters = "0123456789"): string
    {
        $sb = "";

        for($i = 0; $i < $length; $i++)
        {
            $sb .= $usedCharacters[rand(0, strlen($usedCharacters)-1)];
        }

        return $sb;
    }
}
