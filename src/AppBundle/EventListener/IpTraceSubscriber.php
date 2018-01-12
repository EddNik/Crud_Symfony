<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\Employee;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Swift_Message;

/**
 * @property bool needsFlush
 */
class IpTraceSubscriber implements EventSubscriber
{
    protected $templater;
    protected $mailer;

    public function __construct(\Twig_Environment $templater, \Swift_Mailer $mailer)
    {
        $this->templater = $templater;
        $this->mailer = $mailer;
    }

    public function getSubscribedEvents()
    {
        return array(
            'postPersist',
            'postUpdate',
            'postRemove'
        );
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $this->index($args);
    }

    public function index(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        if ($entity instanceof Employee) {
            $message = new Swift_Message();
            $message->setSubject('Data of employee ID ' . $entity->getId() . ' it is ' . $entity->getFirstName() . ' was changed');
            $message->setFrom('evyskrebtsov@gmail.com');
            $message->setTo('nikinna86@gmail.com');
            $message->setBody(
                $this->templater->render(
                'mail/employee.html.twig',
                array('firstName' => $entity->getFirstName(),
                    'lastName' => $entity->getLastName(),
                    'hireDate' => $entity->getHireDate(),
                    'age' => $entity->getAge(),
                    )
            ),
                'text/html'
            );
            $this->mailer->send($message);
        }
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $this->index($args);
    }

    public function postRemove(LifecycleEventArgs $args)
    {
        $this->index($args);
    }
}
