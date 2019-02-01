<?php
/**
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 */

namespace RazeSoldier\GetSiteViewCount\Strategy;

use RazeSoldier\GetSiteViewCount\LogModel\ViewParser;

class AnalysisAllLogStrategy implements IStrategy
{
    const PATTERN = '#^(?<IP>([0-9]{1,3}\.){3}[0-9]{1,3})\s-\s-\s\[(?<time>[0-9]{1,2}/\w*/[0-9]{4}:[0-9]{2}:[0-9]{2}:'.
        '[0-9]{2}\s\+[0-9]{4})\]\s"(?<method>[A-Z]{3,4})\s(?<URL>.*)\s(?<version>HTTP/[0-9]\.[0-9])"\s'.
        '(?<statusCode>[0-9]{3})\s(?<size>[0-9]*)(\s(?<refer>".*")\s(?<UA>".*")$)?#';

    const NEEDLE = [
        '/wiki',
        '/w/index.php',
    ];

    /**
     * @var \SplFileObject
     */
    private $file;

    public function __construct(\SplFileObject $file)
    {
        $this->file = $file;
    }

    public function run()
    {
        $hit = [];
        foreach ($this->file as $line) {
            if (empty($line)) {
                continue;
            }
            try {
                $view = (new ViewParser($line, self::PATTERN))->getResult();
            } catch (\RuntimeException $e) {
                echo "Exception: {$e->getMessage()}\n";
                continue;
            }
            $url = $view->getURL();
            if ($this->matchURL($url)) {
                $date = date('Y-m-d', $view->getTime());
                $this->hit($hit, $date);
            }
        }

        echo "----------------------\n";
        echo "|  Date  | Count |\n";
        foreach ($hit as $date => $count) {
            echo "|  $date  | $count |\n";
        }
        echo "----------------------\n";
    }

    private function matchURL(string $url) : bool
    {
        foreach (self::NEEDLE as $needle) {
            if (strpos($url, $needle) !== false) {
                return true;
            }
        }
        return false;
    }

    private function hit(array &$hit, string $date)
    {
        if (isset($hit[$date])) {
            $hit[$date]++;
        } else {
            $hit[$date] = 1;
        }
    }
}
