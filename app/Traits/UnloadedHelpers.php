<?php
namespace App\Traits;

trait UnloadedHelpers
{
    public static function setEnvironmentValue($envKey, $envValue)
    {
        $envFile = app()->environmentFilePath();
        $contents = file_get_contents($envFile);
        if (preg_match('/[^a-zA-Z0-9]/', $envValue)) {
            $formattedValue = "\"{$envValue}\"";
        } else {
            $formattedValue = $envValue;
        }

        $pattern = "/^{$envKey}=.*$/m";
        $replacement = "{$envKey}={$formattedValue}";

        if (preg_match($pattern, $contents)) {
            $contents = preg_replace($pattern, $replacement, $contents);
        } else {
            $contents .= PHP_EOL . $replacement . PHP_EOL;
        }
        $fp = fopen($envFile, 'w');
        fwrite($fp, $contents);
        fclose($fp);
        return $formattedValue;
    }
}
