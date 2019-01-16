<?php
    use atk4\dsql\Query;
    use atk4\dsql\Expression;
    use Dplus\Base\QueryBuilder;
    use Dplus\ProcessWire\DplusWire;
    
	/**
	 * This file is a file for functions that interact with the database
	 *
	 * CRUD Create Read Update Delete
	 *
	 * Create functions
	 *   1. insert_
	 *   2. create_  ** PREFERED
	 *   - Make sure that these functions return if insert worked
	 *   - e.g. boolval(DplusWire::wire('dplusdatabase')->lastInsertId())
	 * Read functions have many keywords to start the function name
	 *   1. get_   returns the data as one record or an array
	 *   2. count_ returns an integer of records that match query
	 *   3. is_    returns bool for query
	 *             e.g. boolval($sql->fetchColumn());
	 * Update functions
	 *   1. edit_
	 *   2. update_   ** PREFERED
	 *   - Make sure that these functions return if update worked
	 *   - e.g. boolval($sql->rowCount()) // NOTE if no records were updated then it will return false
	 * Delete functions will start with delete_ or remove_
	 *   1. delete_
	 *   2. remove_  ** PREFERED
	 *   - Make sure that these functions return if update worked
	 *   - e.g. boolval($sql->rowCount()) // NOTE if no records were updated then it will return false
	 */

/* =============================================================
	LOGIN FUNCTIONS
============================================================ */
	/**
	 * Returns if User is logged in
	 * @param  string $sessionID Session Identifier
	 * @param  bool   $debug     Run in debug? If so, return SQL Query
	 * @return bool              Is user logged in?
	 */
	function is_validlogin($sessionID, $debug = false) {
		$q = (new QueryBuilder())->table('logperm');
		$q->field($q->expr("IF(validlogin = 'Y', 1, 0)"));
		$q->where('sessionid', $sessionID);
		$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

		if ($debug) {
			return $q->generate_sqlquery();
		} else {
			$sql->execute($q->params);
			return $sql->fetchColumn();
		}
	}
