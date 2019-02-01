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

namespace RazeSoldier\GetSiteViewCount\LogModel;

class ViewParser
{
    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $pattern;

    /**
     * @var View
     */
    private $result;

    public function __construct(string $text, string $pattern)
    {
        $this->text = $text;
        $this->pattern = $pattern;
        $this->parse();
    }

    private function parse()
    {
        if (!preg_match($this->pattern, $this->text, $matches)) {
            throw new \RuntimeException("Failed to parse: {$this->text}");
        }
        $result = new View;
        $result->setTime(strtotime($matches['time']));
        $result->setHttpCode($matches['statusCode']);
        $result->setIp($matches['IP']);
        $result->setHttpMethod($matches['method']);
        $result->setSize($matches['size']);
        $result->setURL($matches['URL']);
        $result->setRefer($matches['refer']);
        $result->setRefer($matches['refer'] ?? null);
        $result->setUA($matches['UA'] ?? null);
        $this->result = $result;
    }

    public function getResult() : View
    {
        return $this->result;
    }
}