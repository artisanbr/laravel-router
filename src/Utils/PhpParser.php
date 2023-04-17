<?php
namespace ArtisanLabs\LaravelRouter\Utils;

class PhpParser
{
    public function extractFileClass(string $file)
    {

        if(!file_exists($file))
            return false;

        $file_content = file_get_contents($file);

        // Obtém os tokens do arquivo
        $tokens = token_get_all($file_content);

        // Percorre os tokens para encontrar a definição da classe
        $class_name = null;
        foreach ($tokens as $key => $token) {
            // Se o token for a definição de uma classe
            if (is_array($token) && $token[0] == T_CLASS) {
                // Obtém o nome da classe
                $class_name = $tokens[$key+2][1]; // $key+2 é o nome da classe na array de tokens
                break;
            }
        }

        return $class_name;

        //return $class_name;

        /*$class = '';
        $i = 0;
        while (!$class) {
            $tokens = token_get_all($file_content);

            for ($iMax = count($tokens); $i< $iMax; $i++) {
                if ($tokens[$i][0] === T_CLASS) {
                    dump($tokens[$i]);
                    for ($j=$i+1, $jMax = count($tokens); $j< $jMax; $j++) {
                        if ($tokens[$j] === '{') {
                            $class = $tokens[$i + 2][1];
                        }
                    }
                }
            }
        }

        return $class;*/
    }

    public function extractFileNamespace(string $file)
    {
        $src = file_get_contents($file);
        $tokens = token_get_all($src);
        $count = count($tokens);
        $i = 0;
        $namespace = '';
        $namespace_ok = false;
        while ($i < $count) {
            $token = $tokens[$i];
            if (is_array($token) && $token[0] === T_NAMESPACE) {
                // Found namespace declaration
                while (++$i < $count) {
                    if ($tokens[$i] === ';') {
                        $namespace_ok = true;
                        $namespace = trim($namespace);
                        break;
                    }
                    $namespace .= is_array($tokens[$i]) ? $tokens[$i][1] : $tokens[$i];
                }
                break;
            }
            $i++;
        }

        if (!$namespace_ok) {
            return null;
        } else {
            return $namespace;
        }
    }
}
