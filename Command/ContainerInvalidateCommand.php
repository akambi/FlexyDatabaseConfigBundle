<?php

namespace Flexy\DatabaseConfigBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Output\Output;

/**
 * A console command for invalidating (clearing) the container cache
 */
class ContainerInvalidateCommand extends ContainerAwareCommand
{
    /**
     * @see Command
     */
    protected function configure()
    {
        $this
            ->setName('flexy:container:invalidate')
            ->setDescription('Invalidate the container cache')
            ->setHelp(<<<EOF
The <info>flexy:container:invalidate</info> invalidate (clear) the container cache.

<info>php app/console flexy:container:invalidate --env=dev</info>
EOF
            )
        ;
    }

    /**
     * @see Command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $kernel = $this->getContainer()->get('kernel');
        $output->writeln(sprintf('Invalidating container for the <info>%s</info> environment', $kernel->getEnvironment()));

        $this->getContainer()->get('flexy_database_config.container_invalidator')->invalidate();
    }

}
