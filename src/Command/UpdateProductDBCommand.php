<?php
// src/Command/CreateUserCommand.php
namespace App\Command;

use App\Entity\Category;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Component\Validator\Validation;

class UpdateProductDBCommand extends Command
{
    private CategoryRepository $categoryRepository;
    private ProductRepository $productRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        ProductRepository  $productRepository
    )
    {
        parent::__construct();
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    protected function configure()
    {
        $this->setName('app:update-product-category')
            ->setDescription('Read from json add/update product, category');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $packages = new Package(new EmptyVersionStrategy());
        $path = $packages->getUrl('app/categories.json');

        $data = file_get_contents($path);
        $categories = json_decode($data, 1);

        $this->categoryRepository->addMultiple($categories);

        $path = $packages->getUrl('app/products.json');

        $dataProduct = file_get_contents($path);
        $products = json_decode($dataProduct, 1);

        $this->productRepository->addMultiple($products);

        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;

        // or return this to indicate incorrect command usage; e.g. invalid options
        // or missing arguments (it's equivalent to returning int(2))
        // return Command::INVALID
    }
}