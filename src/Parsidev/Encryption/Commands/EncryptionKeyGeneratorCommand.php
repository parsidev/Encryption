<?php

namespace Parsidev\Encryption\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class EncryptionKeyGeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'encryption:key {count : count of keys for generate}
                            {--min=10 : Minimum key length}
                            {--max=200 : Maximum key length}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Key(s) for Parsidev Encryption';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $path = ('config/encryption.php');
        $count = $this->argument('count');
        $contents = "<?php

return [
    \"keys\" =>
        [\r\n";
        for ($i = 1; $i <= $count; $i++) {
            $length = rand($this->min(), $this->max());
            $code = $this->generateCode($length);
            $contents .= "\t\t\t\"" . str_replace("\"", $this->generateCode(1),
                    str_replace("$", $this->generateCode(1),
                        str_replace("\r\n", $this->generateCode(1),
                            str_replace("\r", $this->generateCode(1),
                                str_replace("\n", $this->generateCode(1),
                                    str_replace(",", $this->generateCode(1),
                                        str_replace("<", $this->generateCode(1),
                                            str_replace(">", $this->generateCode(1), $code)
                                        )
                                    )
                                )
                            )
                        )
                    )
                ) . "\",\r\n";
        }

        $contents .= "        ]
];";
        File::put($path, $contents);

        $this->info($count . " key(s) generated successfully");
    }

    protected function generateCode($length)
    {
        $string = "e0PfTq2rA6RyZEmaLWBDIiFYkwSObs3t1gX4upJ79QMo8nKhGVvlNjUdzCH5xc";
        $stringLength = strlen($string);
        $result = "";
        for ($i = 0; $i < $length; $i++) {
            $result .= $string[rand(0, $stringLength - 1)];
        }
        return $result;
    }

    protected function getCode($key, $text)
    {
        if ($key == $text)
            $key = $this->generateCode(rand($this->min(), $this->max()));
        $outText = '';
        for ($i = 0; $i < strlen($text);) {
            for ($j = 0; ($j < strlen($key) && $i < strlen($text)); $j++, $i++) {
                $outText .= $text[$i] ^ $key[$j];
            }
        }
        return ($outText);
    }

    /**
     * Get the host for the command.
     *
     * @return int
     */
    protected function min()
    {
        return $this->input->getOption('min');
    }

    /**
     * Get the port for the command.
     *
     * @return int
     */
    protected function max()
    {
        return $this->input->getOption('max');
    }

}
