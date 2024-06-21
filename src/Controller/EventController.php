<?php

namespace App\Controller;

use App\Form\models\SearchEvent;
use App\Form\SearchEventType;
use App\Services\EventService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EventController extends AbstractController
{
    #[Route('/events', name: 'event_list')]
    public function list(Request $request, EventService $eventService): Response
    {

        $searchEvent = new SearchEvent();
        $eventForm = $this->createForm(SearchEventType::class, $searchEvent);
        $eventForm->handleRequest($request);

        //if($eventForm->isSubmitted() && $eventForm->isValid()){
        $events = $eventService->search($searchEvent);
        //}


        return $this->render('event/list.html.twig', [
            'events' => $events,
            'eventForm' => $eventForm
        ]);
    }
}
