<?php
namespace App\Lib;

class AHP {

    private $_matrix = [];
    private $_sumColumns = [];
    private $_normalizeMatrix = [];
    private $_rowAverage = [];
    private $_consistencyMatrix = [];
    private $_consistencyCheck = [];
    private $_multipleScore = [];
    private $_nilaiStandar = [];
    private $_rank = [];
    private $_ci = 0;

    function __construct($matrix)
    {
        $this->_matrix = $matrix;
    }

    function run()
    {
        $this->_sumColumns = $this->sumColumns($this->_matrix);
        $this->_normalizeMatrix = $this->normalizeMatrix($this->_matrix, $this->_sumColumns);
        $this->_rowAverage = $this->rowAverage($this->_normalizeMatrix);
        $this->_consistencyMatrix = $this->consistencyMatrix($this->_matrix, $this->_rowAverage);
        $this->_consistencyCheck = $this->consistencyCheck($this->_consistencyMatrix);
        $this->_multipleScore = $this->multipleScore($this->_matrix, $this->_rowAverage);

        foreach ($this->_nilaiStandar as $key => $value) {
            $tmp_val = 0;
            for ($i=0; $i < count($value); $i++) {
                $tmp_val += $this->_rowAverage[$i] * $value[$i];
            }
            $this->_rank[$key] = $tmp_val;
        }
        arsort($this->_rank);
    }


    #Used to sum columns for synthesization step
    function sumColumns($matrix) {
        $return = array();
        #For each row
        foreach ($matrix as $key=>$val) {
        #For each column
            foreach ($val as $key2=>$val2) {
                if (isset($return[$key2])) {
                    $return[$key2] += $val2;
                }
                else {
                    $return[$key2] = $val2;
                }
            }
        }
        return $return;
    }

    #Used to normalize the matrix for synthesization step
    function normalizeMatrix($matrix, $columnTotals) {
        $return = array();
        #For each row
        foreach($matrix as $key=>$val) {
            #For each column
            foreach($val as $key2=>$val2) {
            #val2 / columnTotals[$key2] == current val / columnTotal of current val's column
            $return[$key][$key2] = $val2/$columnTotals[$key2];
            }
        }
        return $return;
    }

    #Used to return average of row for synthesization step (priority weighting)
    function rowAverage($matrix) {
        $return = array();
        #For each row
        foreach($matrix as $key=>$rowArray) {
            $return[$key] = array_sum($rowArray) / count($rowArray);
        }
        return $return;
    }

    #Used to return (weighted sum value / criteria weight) for each row
    function consistencyMatrix($matrix, $priorities) {
        $return = array();
        #For each row
        foreach($matrix as $key=>$val) {
            #For each column
            foreach($val as $key2=>$val2) {
                if(isset($return[$key])) {
                    $return[$key] += $val2 * $priorities[$key2];
                }
                else {
                    $return[$key] = $val2 * $priorities[$key2];
                }
            }
        }
        #Now $return represents the weighted sum values of each column, calculate the ratio by dividing by priority weights
        foreach($return as $key=>$val) {
            $return[$key] = $val / $priorities[$key];
        }
        return $return;
    }

    function consistencyCheck($consistencyMatrix) {
        $result = array();
        $n = count($consistencyMatrix);
        #Lambda max = average of all consistency weights
        $lambdaMax = array_sum($consistencyMatrix)/$n;
        $result['zmax'] = $lambdaMax;
        // echo "Lambda Max - $lambdaMax <br/>";
        #Consistency index = (lambdaMax - n) / (n - 1)
        $consistencyIndex = ($lambdaMax - $n)/($n - 1);
        $result['ci'] = $consistencyIndex;
        $this->_ci = $consistencyIndex;
        // echo "Consistency Index - $consistencyIndex <br/>";
        #Consistency ratio = Consistency index / Random index
        #If ratio > 0.1 then we can assume matrix is consistent.
        $randomIndex = array(
            1=>0,
            2=>0,
            3=>0.58,
            4=>0.90,
            5=>1.12,
            6=>1.24,
            7=>1.32,
            8=>1.41,
            9=>1.45,
            10=>1.49
        );
        $consistencyRatio = $consistencyIndex/$randomIndex[$n];
        $result['cr'] = $consistencyRatio;
        return $result;
        // echo "Consistency Ratio - $consistencyRatio";
    }

    function multipleScore($matrix, $priorities)
    {
        $result = array();
        for ($i=0; $i < count($matrix); $i++) {
            $tempResult = 0;
            for ($j=0; $j < count($matrix[$i]); $j++) {
                $tempResult = $tempResult + ($matrix[$i][$j] * $priorities[$j]);
            }
            $result[$i] = $tempResult;
        }
        return $result;
    }

    function printTable($arr) {
        $table = "<table border=1px>";
        foreach($arr as $key=>$val) {
            if(is_array($val)) {
                $table .= "<tr>";
                foreach($val as $key2=>$val2) {
                $table .= "<td>$val2</td>";
                }
                $table .= "</tr>";
            }
            else {
                $table .= "<td>$val</td>";
            }
        }
        $table .= "</table>";
        echo $table;
    }

    /**
     * Get the value of _matrix
     */
    public function get_matrix()
    {
        return $this->_matrix;
    }

    /**
     * Get the value of _sumColumns
     */
    public function get_sumColumns()
    {
        return $this->_sumColumns;
    }

    /**
     * Get the value of _normalizeMatrix
     */
    public function get_normalizeMatrix()
    {
        return $this->_normalizeMatrix;
    }

    /**
     * Get the value of _rowAverage
     */
    public function get_rowAverage()
    {
        return $this->_rowAverage;
    }

    /**
     * Get the value of _consistencyMatrix
     */
    public function get_consistencyMatrix()
    {
        return $this->_consistencyMatrix;
    }

    /**
     * Get the value of _consistencyCheck
     */
    public function get_consistencyCheck()
    {
        return $this->_consistencyCheck;
    }

    /**
     * Get the value of _multipleScore
     */
    public function get_multipleScore()
    {
        return $this->_multipleScore;
    }

    public function set_nilaiStandar($Id, $value)
    {
        $this->_nilaiStandar[$Id] = $value;

        return $this;
    }

    /**
     * Get the value of _nilaiStandar
     */
    public function get_nilaiStandar()
    {
        return $this->_nilaiStandar;
    }

    /**
     * Get the value of _rank
     */
    public function get_rank()
    {
        return $this->_rank;
    }

    /**
     * Get the value of _ci
     */
    public function get_ci()
    {
        return $this->_ci;
    }
}



//===========================================================

// data
// ['Lemari 1' =>[]]

// $matrix = array(
//   array(1, 3, 3, 4, 7),
//   array(0.33, 1, 4, 4, 6),
//   array(0.33, 0.25, 1, 3, 5),
//   array(0.25, 0.25, 0.33, 1, 3),
//   array(0.14, 0.17, 0.20, 0.33, 1),
// );
// echo "<h4>Step 1 - Pairwise comparison for criteria<h4>";
// printTable($matrix);
// $ahp = new AHP();
// echo "<h4>Step 2 - Synthesization<h4><h5>Sum column values</h5>";
// $columnSums = $ahp->sumColumns($matrix);
// printTable($columnSums);
// echo "<h5>Normalize pairwise matrix by dividing each element by column total</h5>";
// $normalized = $ahp->normalizeMatrix($matrix, $columnSums);
// printTable($normalized);
// echo "<h5>Compute average of each row - relative priorities</h5>";
// $priorities = $ahp->rowAverage($normalized);
// printTable($priorities);
// echo "Total - " . array_sum($priorities);
// echo "<h4>Step 3 - Consistency<h4><h5>Consistency matrix (Priorities * Original Matrix Columns)</h5>";
// $consistencyMatrix = $ahp->consistencyMatrix($matrix, $priorities);
// printTable($consistencyMatrix);
// echo "<h5>Consistency check</h5>";
// $consistency = $ahp->consistencyCheck($consistencyMatrix);
// echo "<h5>Multiple Score</h5>";
// $multipleScore = $ahp->multipleScore($matrix, $priorities);
// printTable($multipleScore);
?>
