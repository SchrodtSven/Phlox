<?php
require_once '/Users/svenschrodt/projects/Phlox/src/Phlox/Core/Statements/Statement.php';
#namespace SchrodtSven\Phlox\Core\Expressions;
$sub = "Statements";
$directory = '/Users/svenschrodt/projects/Phlox/src/Phlox/Core/'.$sub;
$array = [];
$prfx = '/Users/svenschrodt/projects/Phlox/src/Phlox/Core/'.$sub .'/';
$fileSPLObjects =  new \RecursiveIteratorIterator(
    new \RecursiveDirectoryIterator($directory),
    \RecursiveIteratorIterator::CHILD_FIRST
);

$all =[];
$sfx =  '.php';
try {
    foreach ($fileSPLObjects as $fullFileName => $fileSPLObject) {
        #if (!$fileSPLObject->isDot()) 
        if (str_ends_with($fullFileName, $sfx)) {
            $fn = str_replace($prfx, '', $fullFileName);
            $cn = str_replace($sfx, '', $fn);
            print($fullFileName . PHP_EOL);
            require_once $fullFileName;
            
            $oReflectionClass = new \ReflectionClass('SchrodtSven\Phlox\Core\\'. $sub .'\\' . $cn);
            
            $all[$oReflectionClass->getName()] = [
                'attr' => array_column($oReflectionClass->getProperties(), 'name'),
                'mthd' => array_column($oReflectionClass->getMethods(), 'name')
            ];
            #exit();
            //print( ucfirst(str_replace([$prfx, '.java'], ['', '.php'],$fullFileName)). PHP_EOL);}

        }
    }
} catch (\UnexpectedValueException $e) {
    printf("Directory [%s] contained a directory we can not recurse into", $directory);
}

foreach($all as $k => $item) {
    print "class $k {\n";
    foreach ($item['attr'] as $attr)
        print("\t +" . $attr . PHP_EOL);
    foreach ($item['mthd'] as $m)
        print("\t +" . $m . '()' . PHP_EOL);
    print "}" . PHP_EOL;
}
print_r(implode("\n$sub <|-- ", array_keys($all)));