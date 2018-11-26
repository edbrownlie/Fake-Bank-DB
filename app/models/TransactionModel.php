<?php

class TransactionModel extends Model
{
	public $table = 'Transaction';
	public $transactions;

	public function getAllTransactions() {
	    return $this->getData("SELECT * FROM Transaction_Table");
    }

    public function getTransactionById($id) {
        return $this->getData("SELECT * FROM Transaction_Table WHERE trans_id=" . $id);
    }

	 public function getTransactionByAccountId($id) {
        return $this->getData("SELECT * FROM Transaction_Table WHERE From_accid=" . $id);
    }
		public function getTransactionByClientId($id) {
         return $this->getData("SELECT * FROM Future_Payments INNER JOIN Account ON Transaction_Table.From_accid = Account.Account_id where Client_id =" . $id);
     }

	public function getAccountLoss($id) {
        return $this->getData("SELECT Amount FROM Transaction_Table WHERE From_accid=" . $id ." AND  (Trans_type = 'Payment' OR Trans_type = 'Transfer')");
    }
	public function getAccountProfit($id) {
	       return $this->getData("SELECT Amount FROM Transaction_Table WHERE From_accid=" . $id ." AND  (	Trans_type = 'Sale')");
	  }


	function __construct()
	{
		$this->transactions = json_decode($this->data)->Transaction;
	}
}

?>
