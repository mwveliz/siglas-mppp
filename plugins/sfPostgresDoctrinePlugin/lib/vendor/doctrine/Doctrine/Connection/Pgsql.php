<?php
/*
 *  $Id: Pgsql.php 7490 2010-03-29 19:53:27Z jwage $
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the LGPL. For more information, see
 * <http://www.doctrine-project.org>.
 */

/**
 * Doctrine_Connection_Pgsql
 *
 * @package     Doctrine
 * @subpackage  Connection
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @author      Konsta Vesterinen <kvesteri@cc.hut.fi>
 * @author      Lukas Smith <smith@pooteeweet.org> (PEAR MDB2 library)
 * @version     $Revision: 7490 $
 * @link        www.doctrine-project.org
 * @since       1.0
 */
class Doctrine_Connection_Pgsql extends Doctrine_Connection_Common {
    /**
     * @var string $driverName                  the name of this connection driver
     */
    protected $driverName = 'Pgsql';

    protected $reserved = array(
        '/\babort\b/i',
        '/\babsolute\b/i',
        '/\baccess\b/i',
        '/\baction\b/i',
        '/\badd\b/i',
        '/\bafter\b/i',
        '/\baggregate\b/i',
        '/\ball\b/i',
        '/\balter\b/i',
        '/\banalyse\b/i',
        '/\banalyze\b/i',
        '/\band\b/i',
        '/\bany\b/i',
        '/\bas\b/i',
        '/\basc\b/i',
        '/\bassertion\b/i',
        '/\bassignment\b/i',
        '/\bat\b/i',
        '/\bauthorization\b/i',
        '/\bbackward\b/i',
        '/\bbefore\b/i',
        '/\bbegin\b/i',
        '/\bbetween\b/i',
        '/\bbigint\b/i',
        '/\bbinary\b/i',
        '/\bbit\b/i',
        '/\bboolean\b/i',
        '/\bboth\b/i',
        '/\bby\b/i',
        '/\bcache\b/i',
        '/\bcalled\b/i',
        '/\bcascade\b/i',
        '/\bcase\b/i',
        '/\bcast\b/i',
        '/\bchain\b/i',
        '/\bchar\b/i',
        '/\bcharacter\b/i',
        '/\bcharacteristics\b/i',
        '/\bcheck\b/i',
        '/\bcheckpoint\b/i',
        '/\bclass\b/i',
        '/\bclose\b/i',
        '/\bcluster\b/i',
        '/\bcoalesce\b/i',
        '/\bcollate\b/i',
        '/\bcolumn\b/i',
        '/\bcomment\b/i',
        '/\bcommit\b/i',
        '/\bcommitted\b/i',
        '/\bconstraint\b/i',
        '/\bconstraints\b/i',
        '/\bconversion\b/i',
        '/\bconvert\b/i',
        '/\bcopy\b/i',
        '/\bcreate\b/i',
        '/\bcreatedb\b/i',
        '/\bcreateuser\b/i',
        '/\bcross\b/i',
        '/\bcurrent_date\b/i',
        '/\bcurrent_time\b/i',
        '/\bcurrent_timestamp\b/i',
        '/\bcurrent_user\b/i',
        '/\bcursor\b/i',
        '/\bcycle\b/i',
        '/\bdatabase\b/i',
        '/\bday\b/i',
        '/\bdeallocate\b/i',
        '/\bdec\b/i',
        '/\bdecimal\b/i',
        '/\bdeclare\b/i',
        '/\bdefault\b/i',
        '/\bdeferrable\b/i',
        '/\bdeferred\b/i',
        '/\bdefiner\b/i',
        '/\bdelete\b/i',
        '/\bdelimiter\b/i',
        '/\bdelimiters\b/i',
        '/\bdesc\b/i',
        '/\bdistinct\b/i',
        '/\bdo\b/i',
        '/\bdomain\b/i',
        '/\bdouble\b/i',
        '/\bdrop\b/i',
        '/\beach\b/i',
        '/\belse\b/i',
        '/\bencoding\b/i',
        '/\bencrypted\b/i',
        '/\bend\b/i',
        '/\bescape\b/i',
        '/\bexcept\b/i',
        '/\bexclusive\b/i',
        '/\bexecute\b/i',
        '/\bexists\b/i',
        '/\bexplain\b/i',
        '/\bexternal\b/i',
        '/\bextract\b/i',
        '/\bfalse\b/i',
        '/\bfetch\b/i',
        '/\bfloat\b/i',
        '/\bfor\b/i',
        '/\bforce\b/i',
        '/\bforeign\b/i',
        '/\bforward\b/i',
        '/\bfreeze\b/i',
        '/\bfrom\b/i',
        '/\bfull\b/i',
        '/\bfunction\b/i',
        '/\bget\b/i',
        '/\bglobal\b/i',
        '/\bgrant\b/i',
        '/\bgroup\b/i',
        '/\bhandler\b/i',
        '/\bhaving\b/i',
        '/\bhour\b/i',
        '/\bilike\b/i',
        '/\bimmediate\b/i',
        '/\bimmutable\b/i',
        '/\bimplicit\b/i',
        '/\bin\b/i',
        '/\bincrement\b/i',
        '/\bindex\b/i',
        '/\binherits\b/i',
        '/\binitially\b/i',
        '/\binner\b/i',
        '/\binout\b/i',
        '/\binput\b/i',
        '/\binsensitive\b/i',
        '/\binsert\b/i',
        '/\binstead\b/i',
        '/\bint\b/i',
        '/\binteger\b/i',
        '/\bintersect\b/i',
        '/\binterval\b/i',
        '/\binto\b/i',
        '/\binvoker\b/i',
        '/\bis\b/i',
        '/\bisnull\b/i',
        '/\bisolation\b/i',
        '/\bjoin\b/i',
        '/\bkey\b/i',
        '/\blancompiler\b/i',
        '/\blanguage\b/i',
        '/\bleading\b/i',
        '/\bleft\b/i',
        '/\blevel\b/i',
        '/\blike\b/i',
        '/\blimit\b/i',
        '/\blisten\b/i',
        '/\bload\b/i',
        '/\blocal\b/i',
        '/\blocaltime\b/i',
        '/\blocaltimestamp\b/i',
        '/\blocation\b/i',
        '/\block\b/i',
        '/\bmatch\b/i',
        '/\bmaxvalue\b/i',
        '/\bminute\b/i',
        '/\bminvalue\b/i',
        '/\bmode\b/i',
        '/\bmonth\b/i',
        '/\bmove\b/i',
        '/\bnames\b/i',
        '/\bnational\b/i',
        '/\bnatural\b/i',
        '/\bnchar\b/i',
        '/\bnew\b/i',
        '/\bnext\b/i',
        '/\bno\b/i',
        '/\bnocreatedb\b/i',
        '/\bnocreateuser\b/i',
        '/\bnone\b/i',
        '/\bnot\b/i',
        '/\bnothing\b/i',
        '/\bnotify\b/i',
        '/\bnotnull\b/i',
        '/\bnull\b/i',
        '/\bnullif\b/i',
        '/\bnumeric\b/i',
        '/\bof\b/i',
        '/\boff\b/i',
        '/\boffset\b/i',
        '/\boids\b/i',
        '/\bold\b/i',
        '/\bon\b/i',
        '/\bonly\b/i',
        '/\boperator\b/i',
        '/\boption\b/i',
        '/\bor\b/i',
        '/\border\b/i',
        '/\bout\b/i',
        '/\bouter\b/i',
        '/\boverlaps\b/i',
        '/\boverlay\b/i',
        '/\bowner\b/i',
        '/\bpartial\b/i',
        '/\bpassword\b/i',
        '/\bpath\b/i',
        '/\bpendant\b/i',
        '/\bplacing\b/i',
        '/\bposition\b/i',
        '/\bprecision\b/i',
        '/\bprepare\b/i',
        '/\bprimary\b/i',
        '/\bprior\b/i',
        '/\bprivileges\b/i',
        '/\bprocedural\b/i',
        '/\bprocedure\b/i',
        '/\bread\b/i',
        '/\breal\b/i',
        '/\brecheck\b/i',
        '/\breferences\b/i',
        '/\breindex\b/i',
        '/\breturn\b/i',
        '/\breturns\b/i',
        '/\brelative\b/i',
        '/\brename\b/i',
        '/\breplace\b/i',
        '/\breset\b/i',
        '/\brestrict\b/i',
        '/\breturns\b/i',
        '/\brevoke\b/i',
        '/\bright\b/i',
        '/\brollback\b/i',
        '/\brow\b/i',
        '/\brule\b/i',
        '/\bschema\b/i',
        '/\bscroll\b/i',
        '/\bsecond\b/i',
        '/\bsecurity\b/i',
        '/\bselect\b/i',
        '/\bsequence\b/i',
        '/\bserializable\b/i',
        '/\bsession\b/i',
        '/\bsession_user\b/i',
        '/\bset\b/i',
        '/\bsetof\b/i',
        '/\bshare\b/i',
        '/\bshow\b/i',
        '/\bsimilar\b/i',
        '/\bsimple\b/i',
        '/\bsmallint\b/i',
        '/\bsome\b/i',
        '/\bstable\b/i',
        '/\bstart\b/i',
        '/\bstatement\b/i',
        '/\bstatistics\b/i',
        '/\bstdin\b/i',
        '/\bstdout\b/i',
        '/\bstorage\b/i',
        '/\bstrict\b/i',
        '/\bsubstring\b/i',
        '/\bsysid\b/i',
        '/\btable\b/i',
        '/\btemp\b/i',
        '/\btemplate\b/i',
        '/\btemporary\b/i',
        '/\bthen\b/i',
        '/\btime\b/i',
        '/\btimestamp\b/i',
        '/\bto\b/i',
        '/\btoast\b/i',
        '/\btext\b/i',
        '/\btrailing\b/i',
        '/\btransaction\b/i',
        '/\btreat\b/i',
        '/\btrigger\b/i',
        '/\btrim\b/i',
        '/\btrue\b/i',
        '/\btruncate\b/i',
        '/\btrusted\b/i',
        '/\btype\b/i',
        '/\bunencrypted\b/i',
        '/\bunion\b/i',
        '/\bunique\b/i',
        '/\bunknown\b/i',
        '/\bunlisten\b/i',
        '/\buntil\b/i',
        '/\bupdate\b/i',
        '/\busage\b/i',
        '/\buser\b/i',
        '/\busing\b/i',
        '/\bvacuum\b/i',
        '/\bvalid\b/i',
        '/\bvalidator\b/i',
        '/\bvalues\b/i',
        '/\bvarchar\b/i',
        '/\bvarying\b/i',
        '/\bverbose\b/i',
        '/\bversion\b/i',
        '/\bview\b/i',
        '/\bvolatile\b/i',
        '/\bwhen\b/i',
        '/\bwhere\b/i',
        '/\bwith\b/i',
        '/\bwithout\b/i',
        '/\bwork\b/i',
        '/\bwrite\b/i',
        '/\byear\b/i',
        '/\bzone\b/i',
    );

    /**
     * the constructor
     *
     * @param Doctrine_Manager $manager
     * @param PDO $pdo                          database handle
     */
    public function __construct(Doctrine_Manager $manager, $adapter) {
        // initialize all driver options
        $this->supported = array(
            'sequences'            => true,
            'indexes'              => true,
            'affected_rows'        => true,
            'summary_functions'    => true,
            'order_by_text'        => true,
            'transactions'         => true,
            'savepoints'           => true,
            'current_id'           => true,
            'limit_queries'        => true,
            'LOBs'                 => true,
            'replace'              => 'emulated',
            'sub_selects'          => true,
            'auto_increment'       => 'emulated',
            'primary_key'          => true,
            'result_introspection' => true,
            'prepared_statements'  => true,
            'identifier_quoting'   => true,
            'pattern_escaping'     => true,
        );

        $this->properties['string_quoting'] = array('start'          => "'",
            'end'            => "'",
            'escape'         => "'",
            'escape_pattern' => '\\');

        $this->properties['identifier_quoting'] = array('start'  => '"',
            'end'    => '"',
            'escape' => '"');
        parent::__construct($manager, $adapter);
    }

    protected function _generateUniqueName($type, $parts, $key, $format = '%s', $maxLength = null) {
        if (isset($this->_usedNames[$type][$key])) {
            return $this->_usedNames[$type][$key];
        }
        if ($maxLength === null) {
            $maxLength = $this->properties['max_identifier_length'];
        }

        $generated = implode('_', $parts);

        // If the final length is greater than 64 we need to create an abbreviated fk name
        if (strlen(sprintf($format, $generated)) > $maxLength) {
            $generated = '';

            foreach ($parts as $part) {
                $generated .= $part[0];
            }

            $name = $generated;
        } else {
            $name = $generated;
        }

        while (in_array($name, $this->_usedNames[$type])) {
            $e = explode('_', $name);
            $end = end($e);

            if (is_numeric($end)) {
                unset($e[count($e) - 1]);
                $fkName = implode('_', $e);
                $name = $fkName . '_' . ++$end;
            } else {
                $name .= '_1';
            }
        }

        $this->_usedNames[$type][$key] = $name;

        return $name;
    }

    /**
     * Set the charset on the current connection
     *
     * @param string    charset
     *
     * @return void
     */
    public function setCharset($charset) {
        $query = 'SET NAMES ' . $this->quote($charset);
        $this->exec($query);
        parent::setCharset($charset);
    }

    /**
     * convertBoolean
     * some drivers need the boolean values to be converted into integers
     * when using DQL API
     *
     * This method takes care of that conversion
     *
     * @param array $item
     * @return void
     */
    public function convertBooleans($item) {
        if (is_array($item)) {
            foreach ($item as $key => $value) {
                if (is_bool($value)) {
                    $item[$key] = ($value) ? 'true' : 'false';
                }
            }
        } else {
            if (is_bool($item) || is_numeric($item)) {
                $item = ($item) ? 'true' : 'false';
            }
        }
        return $item;
    }

    /**
     * Changes a query string for various DBMS specific reasons
     *
     * @param string $query         query to modify
     * @param integer $limit        limit the number of rows
     * @param integer $offset       start reading from given offset
     * @param boolean $isManip      if the query is a DML query
     * @return string               modified query
     */
    public function modifyLimitQuery($query, $limit = false, $offset = false, $isManip = false) {
        if ($limit > 0) {
            $query = rtrim($query);

            if (substr($query, -1) == ';') {
                $query = substr($query, 0, -1);
            }

            if ($isManip) {
                $manip = preg_replace('/^(DELETE FROM|UPDATE).*$/', '\\1', $query);
                $from = $match[2];
                $where = $match[3];
                $query = $manip . ' ' . $from . ' WHERE ctid=(SELECT ctid FROM '
                    . $from . ' ' . $where . ' LIMIT ' . $limit . ')';

            } else {
                if (!empty($limit)) {
                    $query .= ' LIMIT ' . $limit;
                }
                if (!empty($offset)) {
                    $query .= ' OFFSET ' . $offset;
                }
            }
        }
        return $query;
    }

    /**
     * return version information about the server
     *
     * @param string $native    determines if the raw version string should be returned
     * @return array|string     an array or string with version information
     */
    public function getServerVersion($native = false) {
        $query = 'SHOW SERVER_VERSION';

        $serverInfo = $this->fetchOne($query);

        if (!$native) {
            $tmp = explode('.', $serverInfo, 3);

            if (empty($tmp[2]) && isset($tmp[1]) && preg_match('/(\d+)(.*)/', $tmp[1], $tmp2)) {
                $serverInfo = array(
                    'major'  => $tmp[0],
                    'minor'  => $tmp2[1],
                    'patch'  => null,
                    'extra'  => $tmp2[2],
                    'native' => $serverInfo,
                );
            } else {
                $serverInfo = array(
                    'major'  => isset($tmp[0]) ? $tmp[0] : null,
                    'minor'  => isset($tmp[1]) ? $tmp[1] : null,
                    'patch'  => isset($tmp[2]) ? $tmp[2] : null,
                    'extra'  => null,
                    'native' => $serverInfo,
                );
            }
        }
        return $serverInfo;
    }

    /**
     * Inserts a table row with specified data.
     *
     * @param Doctrine_Table $table     The table to insert data into.
     * @param array $values             An associative array containing column-value pairs.
     *                                  Values can be strings or Doctrine_Expression instances.
     * @return integer                  the number of affected rows. Boolean false if empty value array was given,
     */
    public function insert(Doctrine_Table $table, array $fields) {
        $tableName = $table->getTableName();

        // column names are specified as array keys
        $cols = array();
        // the query VALUES will contain either expresions (eg 'NOW()') or ?
        $a = array();

        foreach ($fields as $fieldName => $value) {
            if ($table->isIdentifier($fieldName) && $table->isIdentifierAutoincrement() && $value == null) {
                // Autoincrement fields should not be added to the insert statement
                // if their value is null
                unset($fields[$fieldName]);
                continue;
            }
            $colName = $table->getColumnName($fieldName);
            //        	if (preg_match('/[A-Z]/', $table->getColumnName($fieldName))) {
            //        		$colName = '"'.$table->getColumnName($fieldName).'"';
            //        	}
            $cols[] = $this->quoteIdentifier($colName);
            if ($value instanceof Doctrine_Expression) {
                $a[] = $value->getSql();
                unset($fields[$fieldName]);
            } else {
                $a[] = '?';
            }
        }

        if (count($fields) == 0) {
            // Real fix #1786 and #2327 (default values when table is just 'id' as PK)
            return $this->exec('INSERT INTO ' . $this->quoteIdentifier($tableName)
                . ' '
                . ' VALUES (DEFAULT)');
        }

        // build the statement
        $query = 'INSERT INTO ' . $this->quoteIdentifier($tableName)
            . ' (' . implode(', ', $cols) . ')'
            . ' VALUES (' . implode(', ', $a) . ')';

        return $this->exec($query, array_values($fields));
    }

    /**
     * Execute a SQL REPLACE query. A REPLACE query is identical to a INSERT
     * query, except that if there is already a row in the table with the same
     * key field values, the REPLACE query just updates its values instead of
     * inserting a new row.
     *
     * The REPLACE type of query does not make part of the SQL standards. Since
     * practically only MySQL and SQLIte implement it natively, this type of
     * query isemulated through this method for other DBMS using standard types
     * of queries inside a transaction to assure the atomicity of the operation.
     *
     * @param                   string  name of the table on which the REPLACE query will
     *                          be executed.
     *
     * @param   array           an associative array that describes the fields and the
     *                          values that will be inserted or updated in the specified table. The
     *                          indexes of the array are the names of all the fields of the table.
     *
     *                          The values of the array are values to be assigned to the specified field.
     *
     * @param array $keys       an array containing all key fields (primary key fields
     *                          or unique index fields) for this table
     *
     *                          the uniqueness of a row will be determined according to
     *                          the provided key fields
     *
     *                          this method will fail if no key fields are specified
     *
     * @throws Doctrine_Connection_Exception        if this driver doesn't support replace
     * @throws Doctrine_Connection_Exception        if some of the key values was null
     * @throws Doctrine_Connection_Exception        if there were no key fields
     * @throws PDOException                         if something fails at PDO level
     * @ return integer                              number of rows affected
     */
    public function replace(Doctrine_Table $table, array $fields, array $keys) {
        if (empty($keys)) {
            throw new Doctrine_Connection_Exception('Not specified which fields are keys');
        }
        $identifier = (array) $table->getIdentifier();
        $condition = array();

        foreach ($fields as $fieldName => $value) {
            if (in_array($fieldName, $keys)) {
                if ($value !== null) {
                    $colName = $table->getColumnName($fieldName);
                    //        			if (preg_match('/[A-Z]/', $table->getColumnName($fieldName))) {
                    //        				$colName = '"'.$table->getColumnName($fieldName).'"';
                    //        			}
                    $condition[] = $colName . ' = ?';
                    $conditionValues[] = $value;
                }
            }
        }

        $affectedRows = 0;
        if (!empty($condition) && !empty($conditionValues)) {
            $query = 'DELETE FROM ' . $this->quoteIdentifier($table->getTableName())
                . ' WHERE ' . implode(' AND ', $condition);

            $affectedRows = $this->exec($query, $conditionValues);
        }

        $this->insert($table, $fields);

        $affectedRows++;

        return $affectedRows;
    }

    /**
     * deletes table row(s) matching the specified identifier
     *
     * @throws Doctrine_Connection_Exception    if something went wrong at the database level
     * @param string $table         The table to delete data from
     * @param array $identifier     An associateve array containing identifier column-value pairs.
     * @return integer              The number of affected rows
     */
    public function delete(Doctrine_Table $table, array $identifier) {
        $tmp = array();

        foreach (array_keys($identifier) as $id) {
            $colName = $table->getColumnName($id);
            //        	if (preg_match('/[A-Z]/', $table->getColumnName($id))) {
            //        		$colName = '"'.$table->getColumnName($id).'"';
            //        	}
            $tmp[] = $this->quoteIdentifier($colName) . ' = ?';
        }

        $query = 'DELETE FROM '
            . $this->quoteIdentifier($table->getTableName())
            . ' WHERE ' . implode(' AND ', $tmp);

        return $this->exec($query, array_values($identifier));
    }

    /**
     * Updates table row(s) with specified data.
     *
     * @throws Doctrine_Connection_Exception    if something went wrong at the database level
     * @param Doctrine_Table $table     The table to insert data into
     * @param array $values             An associative array containing column-value pairs.
     *                                  Values can be strings or Doctrine_Expression instances.
     * @return integer                  the number of affected rows. Boolean false if empty value array was given,
     */
    public function update(Doctrine_Table $table, array $fields, array $identifier) {
        if (empty($fields)) {
            return false;
        }

        $set = array();
        foreach ($fields as $fieldName => $value) {
            $colName = $table->getColumnName($fieldName);
            //        	if (preg_match('/[A-Z]/', $table->getColumnName($fieldName))) {
            //        		$colName = '"'.$table->getColumnName($fieldName).'"';
            //        	}

            if ($value instanceof Doctrine_Expression) {
                $set[] = $this->quoteIdentifier($colName) . ' = ' . $value->getSql();
                unset($fields[$fieldName]);
            } else {
                $set[] = $this->quoteIdentifier($colName) . ' = ?';
            }
        }

        $params = array_merge(array_values($fields), array_values($identifier));

        $sql = 'UPDATE ' . $this->quoteIdentifier($table->getTableName())
            . ' SET ' . implode(', ', $set)
            . ' WHERE ' . implode(' = ? AND ', $this->quoteMultipleIdentifier($table->getIdentifierColumnNames()))
            . ' = ?';

        return $this->exec($sql, $params);
    }

    /**
     * execute
     * @param string $query     sql query
     * @param array $params     query parameters
     *
     * @return PDOStatement|Doctrine_Adapter_Statement
     */
    public function execute($query, array $params = array()) {

        $new = '';
        $pattern = "/([^\\\\])(\\'.*?[^\\\\]\\')/";
        if (preg_match_all($pattern, $query, $matches)) {
            $new = preg_replace($pattern, '$1{?}', $query);
        } else {
            $new = $query;
        }

        $query = $new;
        $new = preg_replace(array('/,/', '/[^\{]\?[^\}]/', '/[^\{]\?$/'), ' ', $new);
        $new = preg_replace(array('/\\b\w+\(/', '/\)/', '/\(/', '/\:\:\w*/', "/[\:\[\]\+\-;\|\*\/\%\>\<\=]/"), '', $new);
        $T = sfTimerManager::getTimer('parsSQL');
        $new = preg_replace($this->reserved, '', $new);
        $T->addTime();
        $new = preg_replace('/(\w)\s+(\w)/', '$1 $2', $new);

        $vars = array();

        $columnsAndTables = explode(' ', $new);

        foreach ($columnsAndTables as $name) {
            if (preg_match('/[A-Z]/', $name) && !preg_match('/"/', $name)) {
                $vars[$name] = preg_replace(array('/^(\w+)\.(\w+)$/', '/^(\w+)$/'), array('$1."$2"', '"$1"'), $name);
            }
        }

        $query = strtr($query, $vars);

        $parts = explode('{?}', $query);

        $query = $parts[0];

        if (!empty($matches)) {
            foreach ($matches[2] as $key => $param) {
                $query .= $param . $parts[$key + 1];
            }
        }

        return parent::execute($query, $params);
    }

    /**
     * execute
     * @param string $query     sql query
     * @param array $params     query parameters
     *
     * @return PDOStatement|Doctrine_Adapter_Statement
     */
    public function exec($query, array $params = array()) {
        $new = '';
        $pattern = "/([^\\\\])(\\'.*?[^\\\\]\\')/";
        if (preg_match_all($pattern, $query, $matches)) {
            $new = preg_replace($pattern, '$1{?}', $query);
        } else {
            $new = $query;
        }

        $query = $new;
        $new = preg_replace(array('/,/', '/[^\{]\?[^\}]/', '/[^\{]\?$/'), ' ', $new);
        $new = preg_replace(array('/\\b\w+\(/', '/\)/', '/\(/', '/\:\:\w+/', "/[\:\[\]\+\-;\|\*\/\%\>\<\=]/"), '', $new);
        $T = sfTimerManager::getTimer('parsSQL');
        $new = preg_replace($this->reserved, '', $new);
        $T->addTime();
        $new = preg_replace('/(\w)\s+(\w)/', '$1 $2', $new);

        $vars = array();

        $columnsAndTables = explode(' ', $new);

        foreach ($columnsAndTables as $name) {
            if (preg_match('/[A-Z]/', $name) && !preg_match('/"/', $name)) {
                $vars[$name] = preg_replace(array('/^(\w+)\.(\w+)$/', '/^(\w+)$/'), array('$1."$2"', '"$1"'), $name);
            }
        }

        $query = strtr($query, $vars);

        $parts = explode('{?}', $query);

        $query = $parts[0];

        if (!empty($matches)) {
            foreach ($matches[2] as $key => $param) {
                $query .= $param . $parts[$key + 1];
            }
        }

        return parent::exec($query, $params);
    }
}
