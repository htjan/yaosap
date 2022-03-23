<center>apache fonctionne</center>
<?php
echo("<center>PHP fonctionne</center>")
?>

<?php
function test()
{
    static $count = 0;
    echo "count déclaration : ".$count."<br>";

    $count++;
    echo "count++".$count."<br>";
    if ($count < 10) {
        test();
        echo "count<10: ".$count."<br>";
    }
    $count--;
    echo "count--: ".$count."<br>";
}
?>
<pre><?php test(); ?></pre>
