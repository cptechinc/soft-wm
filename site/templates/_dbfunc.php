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

/* =============================================================
	SALES ORDER PICKING FUNCTIONS
============================================================ */
    /**
     * Returns if there is a a whsesession record for that Session
     * @param  string $sessionID Session Identifier
     * @param  bool   $debug     Run in debug? If so, return SQL Query
     * @return bool              Does whsesession record exist for that Session ID
     */
    function does_whsesessionexist($sessionID, $debug = false) {
    	$q = (new QueryBuilder())->table('whsesession');
    	$q->field($q->expr('IF(COUNT(*) > 0, 1, 0)'));
    	$q->where('sessionid', $sessionID);
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		return $sql->fetchColumn();
    	}
    }

    /**
     * Returns an instance WhseSession from loading a WhseSession record for that Session
     * @param  string      $sessionID Session Identifier
     * @param  bool        $debug     Run in debug? If so, return SQL Query
     * @return WhseSession            WhseSession for that Session ID
     */
    function get_whsesession($sessionID, $debug = false) {
    	$q = (new QueryBuilder())->table('whsesession');
    	$q->where('sessionid', $sessionID);
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		$sql->setFetchMode(PDO::FETCH_CLASS, 'WhseSession');
    		return $sql->fetch();
    	}
    }

    /**
     * Returns the Pick Sales Order Header
     * @param  string           $ordn      Sales Order Number
     * @param  bool             $debug     Run in debug? If so, return SQL Query
     * @return Pick_SalesOrder             Pick Sales Order Header
     */
    function get_picksalesorderheader($ordn, $debug = false) {
    	$q = (new QueryBuilder())->table('wmpickhed');
    	$q->where('ordernbr', $ordn);
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		$sql->setFetchMode(PDO::FETCH_CLASS, 'Pick_SalesOrder');
    		return $sql->fetch();
    	}
    }

    /**
     * Returns an Instance of Pick_SalesOrderDetail
     * @param  string                $sessionID Session Identifier
     * @param  bool                  $debug     Run in debug? If so, return SQL Query
     * @return Pick_SalesOrderDetail
     */
    function get_whsesessiondetail($sessionID, $debug = false) {
    	$q = (new QueryBuilder())->table('wmpickdet');
    	$q->where('sessionid', $sessionID);
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		$sql->setFetchMode(PDO::FETCH_CLASS, 'Pick_SalesOrderDetail');
    		return $sql->fetch();
    	}
    }

    /**
     * Returns if there are details to pick
     * @param  string                $sessionID Session Identifier
     * @param  bool                  $debug     Run in debug? If so, return SQL Query
     * @return bool
     */
    function has_whsesessiondetail($sessionID, $debug = false) {
    	$q = (new QueryBuilder())->table('wmpickdet');
    	$q->field($q->expr('IF(COUNT(*) > 0, 1, 0)'));
    	$q->where('sessionid', $sessionID);
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		return $sql->fetchColumn();
    	}
    }

    /**
     * Returns BarcodedItem
     * @param  string       $barcode Barcode
     * @param  bool         $debug   Run in debug? If so, return SQL Query
     * @return BarcodedItem
     */
    function get_barcodeditem($barcode, $debug = false) {
    	$q = (new QueryBuilder())->table('barcodes');
    	$q->where('barcodenbr', $barcode);
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		$sql->setFetchMode(PDO::FETCH_CLASS, 'BarcodedItem');
    		return $sql->fetch();
    	}
    }

    /**
     * Returns the item id for the supplied barcode
     * @param  string $barcode Barcode for an Item
     * @param  bool   $debug   Run in debug? If so, return SQL Query
     * @return string          Item ID
     */
    function get_barcodeditemid($barcode, $debug = false) {
    	$q = (new QueryBuilder())->table('barcodes');
    	$q->field('itemid');
    	$q->where('barcodenbr', $barcode);
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		return $sql->fetchColumn();
    	}
    }

    /**
     * Returns all the barcoded Items for that Item ID
     * @param  string $itemID Item ID
     * @param  bool   $debug  Run in debug? If so, return SQL Query
     * @return array          BarcodedItems
     */
    function get_barcodes_itemid($itemID, $debug = false) {
    	$q = (new QueryBuilder())->table('barcodes');
    	$q->where('itemid', $itemID);
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		$sql->setFetchMode(PDO::FETCH_CLASS, 'BarcodedItem');
    		return $sql->fetchAll();
    	}
    }

    /**
     * Returns distinct (unit of measure) barcoded Items for that Item ID
     * @param  string $itemID Item ID
     * @param  bool   $debug  Run in debug? If so, return SQL Query
     * @return array          BarcodedItems
     */
    function get_barcodes_distinct_uom($itemID, $debug = false) {
    	$q = (new QueryBuilder())->table('barcodes');
    	$q->where('itemid', $itemID);
    	$q->group('unitqty');
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		$sql->setFetchMode(PDO::FETCH_CLASS, 'BarcodedItem');
    		return $sql->fetchAll();
    	}
    }

    /**
     * Returns an array of all the Item barcodes that have been picked
     * // NOTE Each add of an barcode is its own record, so the same
     * barcode can have multiple records
     * @param  string $sessionID Session Identifier
     * @param  string $ordn      Sales Order Number
     * @param  string $itemID    Item ID
     * @param  bool   $debug     Run in debug? If so, return SQL Query
     * @return array             Barcodes picked for that Sales Order and Item ID
     */
    function get_orderpickeditems($sessionID, $ordn, $itemID, $debug = false) {
    	$q = (new QueryBuilder())->table('whseitempick');
    	$q->where('sessionid', $sessionID);
    	$q->where('ordn', $ordn);
    	$q->where('itemid', $itemID);
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		return $sql->fetchAll();
    	}
    }

    /**
     * Removes items picked for this session
     * @param  string $sessionID Session Identifier
     * @param  bool   $debug     Run in debug? If so, @return string SQL Query
     * @return int               Number of rows deleted
     */
    function delete_orderpickeditems($sessionID, $debug = false) {
    	$q = (new QueryBuilder())->table('whseitempick');
    	$q->mode('delete');
    	$q->where('sessionid', $sessionID);
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		return $sql->rowCount();
    	}
    }

    /**
     * Returns the total Qty of all the barcodes picked for this Order and Item ID
     * @param  string $sessionID Session Identifier
     * @param  string $ordn      Sales Order Number
     * @param  string $itemID    Item ID
     * @param  bool   $debug     Run in debug? If so, return SQL Query
     * @return int               Total Qty of all the barcodes picked for this Order and Item ID
     */
    function get_orderpickeditemqtytotal($sessionID, $ordn, $itemID, $debug = false) {
    	$q = (new QueryBuilder())->table('whseitempick');
    	$q->field($q->expr('SUM(qty)'));
    	$q->where('sessionid', $sessionID);
    	$q->where('ordn', $ordn);
    	$q->where('itemid', $itemID);
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		return $sql->fetchColumn();
    	}
    }

    /**
     * Returns an array of total picked Qtys for each pallet of all the barcodes picked for this Order and Item ID
     * @param  string $sessionID Session Identifier
     * @param  string $ordn      Sales Order Number
     * @param  string $itemID    Item ID
     * @param  bool   $debug     Run in debug? If so, return SQL Query
     * @return array             Total Qty of all the barcodes picked for this Order and Item ID
     */
    function get_orderpickeditemqtytotalsbypallet($sessionID, $ordn, $itemID, $debug = false) {
    	$q = (new QueryBuilder())->table('whseitempick');
    	$q->field('palletnbr');
    	$q->field($q->expr('SUM(qty) AS qty'));
    	$q->where('sessionid', $sessionID);
    	$q->where('ordn', $ordn);
    	$q->where('itemid', $itemID);
    	$q->group('palletnbr');
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		return $sql->fetchAll(PDO::FETCH_ASSOC);
    	}
    }

    /**
     * Inserts a new record into the database for the new barcode added for this item / Sales Order
     * // NOTE Logic should be added before using this function
     * @param  string $sessionID Session Identifier
     * @param  string $ordn      Sales Order Number
     * @param  string $barcode   Barcode string
     * @param  int    $palletnbr Pallet Number
     * @param  bool   $debug     Run in debug? If so, return SQL Query
     * @return int               Number of Records Inserted 1 | 0
     */
    function insert_orderpickedbarcode($sessionID, $ordn, $barcode, $palletnbr = 1, $debug = false) {
    	$barcodeditem = BarcodedItem::load($barcode);
    	$pickitem = Pick_SalesOrderDetail::load($sessionID);
    	$recordnumber = $pickitem->get_pickedmaxrecordnumber() + 1;

    	$q = (new QueryBuilder())->table('whseitempick');
    	$q->mode('insert');
    	$q->set('sessionid', $sessionID);
    	$q->set('ordn', $ordn);
    	$q->set('itemid', $barcodeditem->itemid);
    	$q->set('recordnumber', $recordnumber);
    	$q->set('palletnbr', "$palletnbr");
    	$q->set('barcode', $barcode);
    	$q->set('qty', $barcodeditem->unitqty);
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		return DplusWire::wire('dplusdatabase')->lastInsertId();
    	}
    }

    /**
     * Removes barcode record from picked queue
     * @param  string $sessionID Session Identifier
     * @param  string $ordn      Sales Order Number
     * @param  string $barcode   Barcode string
     * @param  int    $palletnbr Pallet Number
     * @param  bool   $debug     Run in debug? If so, return SQL Query
     * @return int               Number of Records affected 1 | 0
     */
    function remove_orderpickedbarcode($sessionID, $ordn, $barcode, $palletnbr = 1, $debug = false) {
    	$barcodeditem = BarcodedItem::load($barcode);
    	$pickitem = Pick_SalesOrderDetail::load($sessionID);

    	$q = (new QueryBuilder())->table('whseitempick');
    	$q->mode('delete');
    	$q->where('sessionid', $sessionID);
    	$q->where('ordn', $ordn);
    	$q->where('barcode', $barcode);
    	$q->where('palletnbr', $palletnbr);
    	$q->where('recordnumber', $pickitem->get_pickedmaxrecordnumberforbarcode($barcode, $palletnbr));
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		return $sql->rowCount();
    	}
    }

    /**
     * Return the MAX record number for the Sales Order Item Picked
     * @param  string $sessionID Session Identifier
     * @param  string $ordn      Sales Order Number
     * @param  string $itemID    Item ID
     * @param  bool   $debug     Run in debug? If so, return SQL Query
     * @return int               whseitempick MAX record number for that SessionID, Sales Order, Item ID
     */
    function get_orderpickeditemmaxrecordnumber($sessionID, $ordn, $itemID, $debug = false) {
    	$q = (new QueryBuilder())->table('whseitempick');
    	$q->field($q->expr('MAX(recordnumber)'));
    	$q->where('sessionid', $sessionID);
    	$q->where('ordn', $ordn);
    	$q->where('itemid', $itemID);
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		return $sql->fetchColumn();
    	}
    }


    /**
     * Return the MAX record number for the Sales Order Item Barcode
     * @param  string $sessionID Session Identifier
     * @param  string $ordn      Sales Order Number
     * @param  string $itemID    Item ID
     * @param  string $barcode   Barcode
     * @param  int    $palletnbr Pallet Nbr
     * @param  bool   $debug     Run in debug? If so, return SQL Query
     * @return int               whseitempick MAX record number for that SessionID, Sales Order, Item ID, barcode
     */
    function get_orderpickedbarcodemaxrecordnumber($sessionID, $ordn, $itemID, $barcode, $palletnbr, $debug = false) {
    	$q = (new QueryBuilder())->table('whseitempick');
    	$q->field($q->expr('MAX(recordnumber)'));
    	$q->where('sessionid', $sessionID);
    	$q->where('ordn', $ordn);
    	$q->where('itemid', $itemID);
    	$q->where('barcode', $barcode);
    	$q->where('palletnbr', $palletnbr);
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		return $sql->fetchColumn();
    	}
    }

/* =============================================================
BINR FUNCTIONS
============================================================ */
    /**
     * Returns the Number of Results for this session
     * @param  string $sessionID Session Identifier
     * @param  bool   $debug     Run in debug? If so, return SQL Query
     * @return int               Number of results for this session
     */
    function count_invsearch($sessionID, $debug = false) {
    	$q = (new QueryBuilder())->table('invsearch');
    	$q->field($q->expr('COUNT(*)'));
    	$q->where('sessionid', $sessionID);
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		return $sql->fetchColumn();
    	}
    }

    /**
     * Returns the Number of Results for this session
     * @param  string $sessionID Session Identifier
     * @param  bool   $debug     Run in debug? If so, return SQL Query
     * @return int               Number of results for this session
     */
    function count_invsearch_distinct_xorigin($sessionID, $debug = false) {
    	$q = (new QueryBuilder())->table('invsearch');
    	$q->field($q->expr('COUNT(DISTINCT(CONCAT(itemid, xorigin)))'));
    	$q->where('sessionid', $sessionID);
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		return $sql->fetchColumn();
    	}
    }

    /**
     * Returns an array of InventorySearchItem of invsearch results
     * @param  string $sessionID Session Identifier
     * @param  bool   $debug     Run in debug? If so, return SQL Query
     * @return array            Array of InventorySearchItem
     */
    function count_invsearchitems_distinct_itemid($sessionID, $debug = false) {
    	$q = (new QueryBuilder())->table('invsearch');
    	$q->field($q->expr('COUNT(DISTINCT(itemid))'));
    	$q->where('sessionid', $sessionID);
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		return $sql->fetchColumn();
    	}
    }

    /**
     * Returns the Number of Results for this session and item id
     * // NOTE COUNTING THE DISTINCT XREF ITEMID solves an issue where
     *         the item is the exact same, it's just an item with the same ITEMID / LOT SERIAL from different X-refs
     * @param  string $sessionID Session Identifier
     * @param  string $itemID    Item ID
     * @param  string $binID     Bin ID to grab Item
     * @param  bool   $debug     Run in debug? If so, return SQL Query
     * @return int               Number of results for this session
     */
    function count_invsearch_itemid($sessionID, $itemID, $binID = '', $debug = false) {
    	$q = (new QueryBuilder())->table('invsearch');
    	$q->field($q->expr('COUNT(DISTINCT(xitemid))'));
    	$q->where('sessionid', $sessionID);
    	$q->where('itemid', $itemID);

    	if (!empty($binID)) {
    		$q->where('bin', $binID);
    	}
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		return $sql->fetchColumn();
    	}
    }

    /**
     * Returns the Number of results for this session and Lot Number / Serial Number
     * // NOTE COUNTING THE DISTINCT XREF ITEMID solves an issue where
     *         the item is the exact same, it's just an item with the same ITEMID / LOT SERIAL from different X-refs
     * @param  string $sessionID Session Identifier
     * @param  string $lotserial Lot Number / Serial Number
     * @param  string $binID     Bin ID to grab Item
     * @param  bool   $debug     Run in debug? If so, return SQL Query
     * @return int               Number of results for this session
     */
    function count_invsearch_lotserial($sessionID, $lotserial, $binID = '', $debug = false) {
    	$q = (new QueryBuilder())->table('invsearch');
    	$q->field($q->expr('COUNT(DISTINCT(xitemid))'));
    	$q->where('sessionid', $sessionID);
    	$q->where('lotserial', $lotserial);

    	if (!empty($binID)) {
    		$q->where('bin', $binID);
    	}
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		return $sql->fetchColumn();
    	}
    }

    /**
     * Returns an array of InventorySearchItem of invsearch results
     * @param  string $sessionID Session Identifier
     * @param  bool   $debug     Run in debug? If so, return SQL Query
     * @return array            Array of InventorySearchItem
     */
    function get_invsearchitems($sessionID, $debug = false) {
    	$q = (new QueryBuilder())->table('invsearch');
    	$q->where('sessionid', $sessionID);
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		$sql->setFetchMode(PDO::FETCH_CLASS, 'InventorySearchItem');
    		return $sql->fetchAll();
    	}
    }

    /**
     * Returns an array of InventorySearchItem of invsearch results
     * @param  string $sessionID Session Identifier
     * @param  bool   $debug     Run in debug? If so, return SQL Query
     * @return array            Array of InventorySearchItem
     */
    function get_invsearchitems_distinct_xorigin($sessionID, $debug = false) {
    	$q = (new QueryBuilder())->table('invsearch');
    	$q->where('sessionid', $sessionID);
    	$q->group('itemid, xorigin');
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		$sql->setFetchMode(PDO::FETCH_CLASS, 'InventorySearchItem');
    		return $sql->fetchAll();
    	}
    }

    /**
     * Returns an array of InventorySearchItem of invsearch results
     * @param  string $sessionID Session Identifier
     * @param  bool   $debug     Run in debug? If so, return SQL Query
     * @return array            Array of InventorySearchItem
     */
    function get_invsearchitems_distinct_itemid($sessionID, $debug = false) {
    	$q = (new QueryBuilder())->table('invsearch');
    	$q->where('sessionid', $sessionID);
    	$q->group('itemid');
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		$sql->setFetchMode(PDO::FETCH_CLASS, 'InventorySearchItem');
    		return $sql->fetchAll();
    	}
    }

    /**
     * Returns the first item found in invsearch table
     * @param  string $sessionID Session Identifier
     * @param  bool   $debug     Run in debug? If so, return SQL Query
     * @return InventorySearchItem
     */
    function get_firstinvsearchitem($sessionID, $debug = false) {
    	$q = (new QueryBuilder())->table('invsearch');
    	$q->where('sessionid', $sessionID);
    	$q->limit(1);
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		$sql->setFetchMode(PDO::FETCH_CLASS, 'InventorySearchItem');
    		return $sql->fetch();
    	}
    }

    /**
     * Returns the first item found in invsearch table with the provided itemid
     * @param  string $sessionID Session Identifier
     * @param  string $itemID    Item ID
     * @param  string $binID     Bin ID to grab Item
     * @param  bool   $debug     Run in debug? If so, return SQL Query
     * @return InventorySearchItem
     */
    function get_invsearchitem_itemid($sessionID, $itemID, $binID = '', $debug = false) {
    	$q = (new QueryBuilder())->table('invsearch');
    	$q->where('sessionid', $sessionID);
    	$q->where('itemid', $itemID);

    	if (!empty($binID)) {
    		$q->where('bin', $binID);
    	}
    	$q->limit(1);
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		$sql->setFetchMode(PDO::FETCH_CLASS, 'InventorySearchItem');
    		return $sql->fetch();
    	}
    }

    /**
     * Returns the first item found in invsearch table with the provided lotserial number
     * @param  string $sessionID Session Identifier
     * @param  string $lotserial Lot Number / Serial Number
     * @param  string $binID     Bin ID to grab Item
     * @param  bool   $debug     Run in debug? If so, return SQL Query
     * @return InventorySearchItem
     */
    function get_invsearchitem_lotserial($sessionID, $lotserial, $binID = '', $debug = false) {
    	$q = (new QueryBuilder())->table('invsearch');
    	$q->where('sessionid', $sessionID);
    	$q->where('lotserial', $lotserial);
    	$q->limit(1);
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		$sql->setFetchMode(PDO::FETCH_CLASS, 'InventorySearchItem');
    		return $sql->fetch();
    	}
    }

    /**
     * Returns an array of bins that this item ID is found in
     * @param  string $sessionID Session Identifier
     * @param  string $itemID    Item ID
     * @param  bool   $debug     Run in debug? If so, return SQL Query
     * @return array             ItemBinInfo
     */
    function get_bininfo_itemid($sessionID, $itemID, $debug = false) {
    	$item = get_invsearchitem_itemid($sessionID, $itemID);
    	$q = (new QueryBuilder())->table('bininfo');
    	$q->where('sessionid', $sessionID);
    	$q->where('itemid', $itemID);

    	if (!$item->is_lotted()) {
    		$q->field('*');
    		$q->field($q->expr('SUM(qty) AS qty'));
    		$q->group('bin');
    	}
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		$sql->setFetchMode(PDO::FETCH_CLASS, 'ItemBinInfo');
    		return $sql->fetchAll();
    	}
    }

    /**
     * Returns an array of bins that this lotserial is found in
     * @param  string $sessionID  Session Identifier
     * @param  string $lotserial  Lot Number / Serial Number
     * @param  bool   $debug      Run in debug? If so, return SQL Query
     * @return array              ItemBinInfo
     */
    function get_bininfo_lotserial($sessionID, $lotserial, $debug = false) {
    	$q = (new QueryBuilder())->table('bininfo');
    	$q->where('sessionid', $sessionID);
    	$q->where('lotserial', $lotserial);
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		$sql->setFetchMode(PDO::FETCH_CLASS, 'ItemBinInfo');
    		return $sql->fetchAll();
    	}
    }

    /**
     * Returns qty for an item in its bin
     * @param  string              $sessionID  Session Identifier
     * @param  InventorySearchItem $item       Item
     * @param  bool                $debug      Run in debug? If so, return SQL Query
     * @return array              ItemBinInfo
     */
    function get_bininfo_qty($sessionID, InventorySearchItem $item, $debug = false) {
    	$q = (new QueryBuilder())->table('bininfo');
    	$q->field('qty');
    	$q->where('sessionid', $sessionID);
    	$q->where('itemid', $item->itemid);

    	if ($item->is_lotted() || $item->is_serialized()) {
    		$q->where('lotserial', $item->lotserial);
    	}
    	$q->where('bin', $item->bin);

    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		return $sql->fetchColumn();
    	}
    }

    /**
     * Returns WhseConfig Record
     * @param  string $whseID Warehouse ID
     * @param  bool   $debug  Run in debug? If so, return SQL Query
     * @return WhseConfig     Whse Configuration
     */
    function get_whsetbl($whseID, $debug = false) {
    	$q = (new QueryBuilder())->table('whse_tbl');
    	$q->where('whseid', $whseID);
    	$q->limit(1);
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		$sql->setFetchMode(PDO::FETCH_CLASS, 'WhseConfig');
    		return $sql->fetch();
    	}
    }

    /**
     * Returns the WhseBin for the range
     * @param  string $whseID Warehouse ID
     * @param  bool   $debug  Run in debug? If so, return SQL Query
     * @return WhseBin
     */
    function get_bnctl_range($whseID, $debug = false) {
    	$q = (new QueryBuilder())->table('bincntl');
    	$q->where('warehouse', $whseID);
    	$q->limit(1);
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		$sql->setFetchMode(PDO::FETCH_CLASS, 'WhseBin');
    		return $sql->fetch();
    	}
    }

    /**
     * Returns the WhseBins for the range
     * @param  string $whseID Warehouse ID
     * @param  bool   $debug  Run in debug? If so, return SQL Query
     * @return array          WhseBin
     */
    function get_bnctl_list($whseID, $debug = false) {
    	$q = (new QueryBuilder())->table('bincntl');
    	$q->where('warehouse', $whseID);
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		$sql->setFetchMode(PDO::FETCH_CLASS, 'WhseBin');
    		return $sql->fetchAll();
    	}
    }

    /**
     * Returns if $binID is a correct bin ID according to the range rules
     * @param  string $whseID Warehouse ID
     * @param  string $binID  bin ID to validate
     * @param  bool   $debug  Run in debug? If so, return SQL Query
     * @return bool           Is $binID a valid bin?
     */
    function validate_bnctl_binrange($whseID, $binID, $debug = false) {
    	$q = (new QueryBuilder())->table('bincntl');
    	$q->field('COUNT(*)');
    	$q->where('warehouse', $whseID);
    	$q->where($q->expr("[] BETWEEN binfrom AND binthru", [$binID]));
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		$sql->setFetchMode(PDO::FETCH_CLASS, 'WhseBin');
    		return boolval($sql->fetchColumn());
    	}
    }

    /**
     * Returns if $binID is an existing bin in the bin list
     * @param  string $whseID Warehouse ID
     * @param  string $binID  bin ID to validate
     * @param  bool   $debug  Run in debug? If so, return SQL Query
     * @return bool           Is $binID an existing bin?
     */
    function validate_bnctl_binlist($whseID, $binID, $debug = false) {
    	$q = (new QueryBuilder())->table('bincntl');
    	$q->field('COUNT(*)');
    	$q->where('warehouse', $whseID);
    	$q->where('binfrom', $binID);
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		return boolval($sql->fetchColumn());
    	}
    }

    function get_item_im($itemid, $debug = false) {
    	$q = (new QueryBuilder())->table('itemmaster');
    	$q->where('itemid', $itemid);
    	$sql = DplusWire::wire('dplusdatabase')->prepare($q->render());

    	if ($debug) {
    		return $q->generate_sqlquery($q->params);
    	} else {
    		$sql->execute($q->params);
    		$sql->setFetchMode(PDO::FETCH_CLASS, 'ItemMasterItem');
    		return $sql->fetch();
    	}
    }
