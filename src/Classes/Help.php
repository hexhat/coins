<?php

declare(strict_types=1);

namespace Hexhat\Coins;

class Help
{
    public function getHelp(): string
    {
        return $this->help;
    }

    private string $help = <<<END
    Usage: coins [ARG...] [OPT_ARG...]
      -h, --help        show this message
      -c, --cron        print total sum as a short, single string (default)
      -r, --report      print verbose list of all currencies
      -v, --verbose     same as --report

    END;
}
