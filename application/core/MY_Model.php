<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

/**
*
* @version 1.0
* @author Carlo Cano <carlocano03gmail.com>
* @copyright Copyright &copy; 2022,
*
*/

class MY_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set( TIMEZONE );
    }

    /* --------------------------------------------------------------
    * CRUD INTERFACE
    * ------------------------------------------------------------ */

    /**
    * Fetch a single field based on the primary key. Returns a column value.
    */

    public function get( $table_name, $field, $where = array() ) {
        $this->db->select( $field );
        $this->db->from( $table_name );

        if ( $where ) {
            foreach ( $where as $key => $value ) {
                $this->db->where( $key, $value );
            }
        }

        return $this->db->get()->row( $field );
    }

    /**
    *
    * @description This function will count all the records
    * @param $table_name - branches
    * @param $where - ( br_id - 1, status - 0, ... )
    * @param $like - ( br_no - 'string', br_name - 'string', ... )
    * @return integer
    *
    */

    public function get_count( $table_name, $where = array(), $like = array() ) {
        $this->db->select( '*' );
        $this->db->from( $table_name );

        if ( $where ) {
            foreach ( $where as $key => $value ) {
                $this->db->where( $key, $value );
            }
        }

        if ( $like ) {
            foreach ( $like as $key => $value ) {
                if ( $key === array_key_first( $like ) ) {
                    $this->db->like( $key, $value );
                } else {
                    $this->db->or_like( $key, $value );
                }
            }
        }

        return $this->db->count_all_results();
    }

    /**
    *
    * @description This function will get the selected row of record
    * @param $table_name - branches
    * @param $where - ( br_id - 1, status - 0, ... )
    * @return return the selected row of record
    *
    */

    public function get_row( $table_name, $where = array() ) {
        $this->db->select( '*' );
        $this->db->from( $table_name );

        if ( $where ) {
            foreach ( $where as $key => $value ) {
                $this->db->where( $key, $value );
            }
        }

        return $this->db->get()->row_array();
    }

    /**
    *
    * @description This function will get the list of record
    * @param $table_name - branches
    * @param $where - ( id - 1, status - 0, ... )
    * @param $order_by - ( id - ASC, status - DESC, ... )
    * @return return the list of record
    *
    */

    public function get_result( $table_name, $where = array(), $order_by = array() ) {
        $this->db->select( '*' );
        $this->db->from( $table_name );

        if ( $where ) {
            foreach ( $where as $key => $value ) {
                $this->db->where( $key, $value );
            }
        }

        if ( $order_by ) {
            foreach ( $order_by as $key => $value ) {
                $this->db->order_by( $key, $value );
            }
        }

        return $this->db->get()->result_array();
    }

    /**
    *
    * @description This function will get the list of record
    * @param $table_name - branches
    * @param $where - ( id - 1, status - 0, ... )
    * @param $where_not_in - ( id - ASC, status - DESC, ... )
    * @return return the number of rows
    *
    */

    public function is_unique_not_in( $table_name, $where = array(), $where_not_in = array() ) {

        $this->db->from( $table_name );

        if ( $where ) {
            foreach ( $where as $key => $value ) {
                $this->db->where( $key, $value );
            }
        }

        if ( $where_not_in ) {
            foreach ( $where_not_in as $key => $value ) {
                $this->db->where_not_in( $key, $value );
            }
        }

        return $this->db->count_all_results();
    }

    /**
    *
    * @description Update a record from the table_name by the primary value
    *
    */

    public function update( $table_name, $set = array(), $where = array() ) {
        $this->db->trans_start();
        // Start transaction

        if ( $set ) {
            foreach ( $set as $key => $value ) {
                $this->db->set( $key, $value );
                // Set change
            }
        }

        if ( $where ) {
            foreach ( $where as $key => $value ) {
                $this->db->where( $key, $value );
                // Where condition
            }
        }

        $this->db->update( $table_name );
        // Update query

        if ( $this->db->affected_rows() > 0 ) {
            // Check if the query was successful
            $this->db->trans_commit();
            // Commit transaction
        } else {
            $this->db->trans_rollback();
            // Rollback transaction
        }

    }

    /**
    *
    * @description Delete a row from the table by the primary value
    *
    */

    public function delete( $table_name, $where = array() ) {
        $this->db->trans_start();
        // Start transaction

        if ( $where ) {
            foreach ( $where as $key => $value ) {
                $this->db->where( $key, $value );
                // Where condition
            }
        }

        $this->db->delete( $table_name );
        // Delete query

        if ( $this->db->affected_rows() > 0 ) {
            // Check if the query was successful
            $this->db->trans_commit();
            // Commit transaction
        } else {
            $this->db->trans_rollback();
            // Rollback transaction
        }

    }
}
