<?php


namespace core\services\import;

use core\repositories\chemical\ChemicalRepository;
use core\repositories\ingredient\IngredientRepository;
use core\services\chemical\ChemicalIngredientAssignmentService;
use core\services\chemical\ChemicalService;
use core\services\entomophage\EntomophageService;
use core\services\ingredient\IngredientService;
use core\services\match\ChemicalEntomophageMatchService;
use core\useCases\BaseService;
use yii\web\UploadedFile;


class ImportService extends BaseService
{

    /**
     * @var ChemicalService
     */
    private $chemicalService;

    /**
     * @var IngredientService
     */
    private $ingredientService;

    /**
     * @var EntomophageService
     */
    private $entomophageService;

    /**
     * @var ChemicalIngredientAssignmentService
     */
    private $chemicalIngredientAssignmentService;

    /**
     * @var ChemicalEntomophageMatchService
     */
    private $chemicalEntomophageMatchService;

    /**
     * @var IngredientRepository
     */
    private $ingredients;

    /**
     * @var ChemicalRepository
     */
    private $chemicals;

    private $matches = [
        '+' => 1,
        '-' => 2,
        '%' => 3,
        '?' => 4,
    ];

    public function __construct(
        ChemicalService $chemicalService,
        IngredientService $ingredientService,
        EntomophageService $entomophageService,
        ChemicalIngredientAssignmentService $chemicalIngredientAssignmentService,
        ChemicalEntomophageMatchService $chemicalEntomophageMatchService,
        IngredientRepository $ingredients,
        ChemicalRepository $chemicals
    )
    {
        $this->chemicalService = $chemicalService;
        $this->ingredientService = $ingredientService;
        $this->entomophageService = $entomophageService;
        $this->chemicalIngredientAssignmentService = $chemicalIngredientAssignmentService;
        $this->chemicalEntomophageMatchService = $chemicalEntomophageMatchService;
        $this->ingredients = $ingredients;
        $this->chemicals = $chemicals;
    }

    public function importByUpload(UploadedFile $file): void
    {
//        $this->chemicalIngredientAssignmentService->truncate();
//        $this->chemicalEntomophageMatchService->truncate();
//
//        $this->entomophageService->truncate();
//        $this->chemicalService->truncate();

        $lines = $this->readFileXLSX($file->tempName);

        $header = array_shift($lines);

        $count = count($header) - 2;
        $entomophages = array_slice($header, 2, $count, true);

        $this->importChemical($lines, $header, $entomophages);

    }

    public function importChemical($lines, $header, $entomophages)
    {

        foreach ($lines as $line) {

            $chemicalName = $line[0];
            $ingredientNames = explode(',', $line[1]);

            if ($chemical = $this->chemicalService->getOrInsert($chemicalName, 1)) {

                foreach ($ingredientNames as $ingredientName){
                    $ingredient = $this->ingredientService->getOrInsert($ingredientName, 1);

                    $chemical->assignIngredient($ingredient->id);
                    $this->chemicals->save($chemical);
                }
            }

            foreach ($entomophages as $key => $entomophage){

                $match = $line[$key];
                $entomophage = $this->entomophageService->getOrInsert($entomophage, 1);

                $this->chemicalEntomophageMatchService->getOrInsert(
                    $chemical->id,
                    $entomophage->id,
                    $this->matches[$match]
                );
            }

        }

    }
}