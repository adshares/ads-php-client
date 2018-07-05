<?php
/**
 * Created by PhpStorm.
 * User: mpila
 * Date: 05.07.2018
 * Time: 17:13
 */

namespace Adshares\Ads\Command;


interface CommandInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return array
     */
    public function getAttributes(): array;

    /**
     * @return null|string
     */
    public function getLastHash(): ?string;

    /**
     * @return null|string
     */
    public function getLastMessageId(): ?string;
}