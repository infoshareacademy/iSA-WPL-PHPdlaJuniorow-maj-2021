<?php declare(strict_types=1);

namespace App\Domain\Product;

/**
 * Class OrderService
 */
class ProductService
{
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var ProductDescriptionRepository
     */
    private $productDescriptionRepository;

    public function __construct(
        ProductRepository $productRepository,
        ProductDescriptionRepository $productDescriptionRepository
    ) {
        $this->productRepository = $productRepository;
        $this->productDescriptionRepository = $productDescriptionRepository;
    }

    public function getProduct(int $id): array
    {
        // pobieramy informacje o kazdym produkcie ze zrodla danych
        $productData = $this->productRepository->getProductDataById($id);
        // pobieramy opis produktu z innego zrodla
        $productDescription = $this->productDescriptionRepository->getProductDescriptionById($id);

        return [
            'nazwa' => $productData['name'],
            'cena' => $productData['price'],
            'opis' => $productDescription,
        ];
    }
}
