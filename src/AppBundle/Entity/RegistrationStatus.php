<?php

namespace AppBundle\Entity;


class RegistrationStatus
{
    const FAILED = -1;
    const CANCELED = 0;
    const PENDING = 1;
    const SUCCESS = 3;
}