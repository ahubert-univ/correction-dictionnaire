<?php

namespace App\Controller;

use App\Entity\Dictionary;
use App\Service\DictionaryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DictionaryController extends AbstractController
{
    public function __construct(private readonly DictionaryService $dictionaryService)
    {

    }

    #[Route('/dictionary/show/{id}', name: 'dictionary_show')]
    public function show(Dictionary $dictionary): Response
    {
        return $this->render('crud_translation/showId.html.twig',[
            'dictionary' => $dictionary,
        ]);
    }

    #[Route('/dictionary/create', name: 'dictionary_create')]
    public function create(): Response
    {
        $this->dictionaryService->create("ordinateur","computer","fr","en");

        return new Response("Entry was created");
    }

    #[Route('/dictionary/update/{id}', name: 'dictionary_update')]
    public function update(Dictionary $dictionary): Response
    {
        $this->dictionaryService->update($dictionary,"ordinateur","computadora","fr","es");

        return new Response("Entry was updated");
    }

    #[Route('/dictionary/delete/{id}', name: 'dictionary_delete')]
    public function delete(Dictionary $dictionary): Response
    {
        $this->dictionaryService->delete($dictionary);

        return new Response("Entry was deleted");
    }

}
