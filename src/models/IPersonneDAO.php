<?php

namespace myProject\Forum\Models;


interface IPersonneDAO
{
    public function save(PersonneDTO &$dto);
}