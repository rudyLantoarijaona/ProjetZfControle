<?php

declare(strict_types=1);

namespace Meetup\Controller;

use Meetup\Entity\Meetup;
use Meetup\Repository\MeetupRepository;
use Meetup\Form\Meetupform;
use Zend\Http\PhpEnvironment\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

final class IndexController extends AbstractActionController
{
    /**
     * @var FilmRepository
     */
    private $meetupRepository;

    /**
     * @var Meetupform
     */
    private $Meetupform;

    public function __construct(MeetupRepository $meetupRepository, Meetupform $Meetupform)
    {
        $this->MeetupRepository = $meetupRepository;
        $this->Meetupform = $Meetupform;
    }

    public function indexAction()
    {
        return new ViewModel([
            'meetup' => $this->MeetupRepository->findAll(),
        ]);
    }

    public function addAction()
    {
        $form = $this->Meetupform;

        /* @var $request Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $meetup = $this->MeetupRepository->createMeetup(
                    $form->getData()['title'],
                    $form->getData()['description'],
                    $form->getData()['dateStart'],
                    $form->getData()['dateEnd'] ?? ''
                );
                $this->MeetupRepository->add($meetup);
                return $this->redirect()->toRoute('meetup');
            }
        }

        $form->prepare();

        return new ViewModel([
            'form' => $form,
        ]);
    }
}
