<?php

namespace App;

final class Split
{
    /**
     * Feladat 01:
     * A $szoveg tartalmát válaszd szét a ";"-k mentén.
     * Azokat a részeket, amiben van "u" betű mentsd el a $tomb külön-külön elemeibe, sorban a 0. indextől kezdve.
     */

    public function getIndexedArray($text, $letter, $delimiter = ";")
    {
        $containsSpecificElementArray = array();

        $index = 0;

        $splitted = explode($delimiter, $text);

        foreach ($splitted as $splElement) {
            if (strpos($splElement, $letter) !== false) {
                $containsSpecificElementArray[$index++] = $splElement;
            }
        }
        return $containsSpecificElementArray;
    }

    /**
     * Feladat 02:
     * A kapcsolat.csv fileból olvasd be a sorokat egy-egy asszociatív tömbbe.
     *
     * Az asszociatív tömböket pedig sorban rakd bele a $csvLines-ba.
     * Az első sort a $csvLines[0]-ba, a második sort a $csvLines[1]-be, ...
     *
     * A kapcsolat.csv filet nem módosíthatod, csak ezt a filet szerkeszd.
     */

    public function getAssociativeArray($resource, $delimiter = ";")
    {
        $csvLines = array();
        try {
            $openedCsv = fopen(__DIR__ . "/" . $resource, 'r');
            $keys = fgetcsv($openedCsv, 1024, $delimiter);

            while (!feof($openedCsv)) {
                $rows = fgetcsv($openedCsv, 1024, $delimiter);
                $assocArray = [];

                if (is_array($rows)) {
                    foreach ($rows as $index => $value) {
                        $assocArray[$keys[$index]] =  utf8_encode($value);
                    }
                }
                array_push($csvLines, $assocArray);
            }
            fclose($openedCsv);
        } catch (\Throwable $th) {
            throw new ResourceNotFoundException("No such file or directory");
        }

        return $csvLines;
    }
}
