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

class View
{
    private $ip;

    private $httpMethod;

    private $URL;

    private $time;

    private $httpCode;

    private $size;

    private $refer;

    private $UA;

    /**
     * @return string
     */
    public function getIp() : string
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     */
    public function setIp(string $ip)
    {
        $this->ip = $ip;
    }

    /**
     * @return string
     */
    public function getHttpMethod() : string
    {
        return $this->httpMethod;
    }

    /**
     * @param string $httpMethod
     */
    public function setHttpMethod(string $httpMethod)
    {
        $this->httpMethod = $httpMethod;
    }

    /**
     * @return string
     */
    public function getURL() : string
    {
        return $this->URL;
    }

    /**
     * @param string $uri
     */
    public function setURL(string $uri)
    {
        $this->URL = $uri;
    }

    /**
     * @return int
     */
    public function getTime() : int
    {
        return $this->time;
    }

    /**
     * @param int $time
     */
    public function setTime(int $time)
    {
        $this->time = $time;
    }

    /**
     * @return int
     */
    public function getHttpCode() : int
    {
        return $this->httpCode;
    }

    /**
     * @param int $httpCode
     */
    public function setHttpCode(int $httpCode)
    {
        $this->httpCode = $httpCode;
    }

    /**
     * @return int
     */
    public function getSize() : int
    {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize(int $size)
    {
        $this->size = $size;
    }

    /**
     * @return string|null
     */
    public function getRefer()
    {
        return $this->refer;
    }

    public function setRefer(string $refer = null)
    {
        $this->refer = $refer;
    }

    /**
     * @return string|null
     */
    public function getUA()
    {
        return $this->UA;
    }

    /**
     * @param mixed $UA
     */
    public function setUA(string $UA = null)
    {
        $this->UA = $UA;
    }
}