<?php
declare(strict_types=1);

namespace Meetup\Controller;

use Meetup\Entity\Meetup;
use Meetup\Repository\MeetupRepository;
use Meetup\Form\Meetupform;
use Zend\Http\PhpEnvironment\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

final class DisplayController extends AbstractActionController
{
    /**
     * @var MeetupRepository
     */
    private $meetupRepository;
    /**
     * @var MeetupForm
     */
    private $MeetupForm;
    
    public function __construct(MeetupRepository $meetupRepository, Meetupform $MeetupForm)
    {
        $this->MeetupRepository = $meetupRepository;
        $this->MeetupForm = $MeetupForm;
    }
    public function indexAction()
    {
        $id = $this->params()->fromRoute('id');
        return new ViewModel([
            'meetups' => $this->MeetupRepository->findById($id),
             
        ]);
    }
   
    public function updateAction()
    {
        $form = $this->MeetupForm;
        $id = $this->params()->fromRoute('id');

        $meetup = $this->MeetupRepository->findById($id)[0];
        $request = $this->getRequest();
 /*$form->setDefaults(array(
           'title'=> $meetup->getTitle()
         ));
         var_dump($form->title);*/

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $meetup->setTitle($form->getData()['title']);
                $meetup->setDescription($form->getData()['description']);
                $meetup->setDateStart(new \DateTime($form->getData()['dateStart']));
                $meetup->setDateEnd(new \DateTime($form->getData()['dateEnd']));
                $this->MeetupRepository->update($meetup);
                return $this->redirect()->toRoute('home');
            }
        }
        $form->prepare();
        return new ViewModel([
            'meetups' => $this->MeetupRepository->findById($id),
            'form' => $form,
        ]);
    }
    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id');
        $meetup = $this->MeetupRepository->findOneBy(array('id' => $id));
        $this->MeetupRepository->delete($meetup);
        return $this->redirect()->toRoute('meetup');
    }
}