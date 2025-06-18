<?php

namespace core\Enums;

enum TransferType: string
{
    case COMPANY_TO_RETAIL = 'company_to_retail';
    case RETAIL_TO_COMPANY = 'retail_to_company';
    case SAME_AGENCY = 'same_agency';
    case COMPANY_TO_COMPANY = 'company_to_company';
}
