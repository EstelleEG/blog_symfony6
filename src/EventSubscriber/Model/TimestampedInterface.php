<?php
//define 4 properties
namespace App\Model;

interface TimestampedInterface
{

    public function getCreatedAt(): ?\DateTimeInterface;

    public function setCreatedAt(\DateTimeInterface $createdAt): self;

    public function getUpdatedAt(): ?\DateTimeInterface;

    public function setUpdatedAt(\DateTimeInterface $modifiedAt): self;
}