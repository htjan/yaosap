<?php
namespace htjan\yaosap\BankAccount;

use htjan\yaosap\Transaction\TransactionList;

class BankAccountData
{
    public $bank_account_id     = 0;
    
    public $owner               = null;
    public $bank_company_id     = null;
    
    public $iban                = '';
    public $bic                 = '';
    public $rib                 = '';
    
    public $transaction_list    = array();
    
    public function __construct($bank_account_id) {
        /* Chercher le compte en base de données 
         * par son identifiant $id
         */
        self::$transaction_list[0]  = new TransactionList();
    }
    
    
}

