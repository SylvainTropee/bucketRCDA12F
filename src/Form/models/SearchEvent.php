<?php

namespace App\Form\models;

class SearchEvent
{
    private ?string $search = null;

    private ?\DateTime $startDate = null;

    public function getSearch(): ?string
    {
        return ucfirst(strtolower($this->search));
       }

    public function setSearch(?string $search): void
    {
        $this->search = $search;
    }

    public function getStartDate(): ?\DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }






}