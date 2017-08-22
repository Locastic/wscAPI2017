<?php

namespace AppBundle\Handler;

use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Util\TokenGeneratorInterface;

/**
 * Class UserHandler
 *
 * @package AppBundle\Handler
 */
class UserHandler
{
    /**
     * @var \Swift_Mailer
     */
    private $swiftMailer;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @var TokenGeneratorInterface
     */
    private $tokenGenerator;

    /**
     * UserHandler constructor.
     *
     * @param \Swift_Mailer $swiftMailer
     * @param \Twig_Environment $twig
     * @param TokenGeneratorInterface $tokenGenerator
     */
    public function __construct(
        \Swift_Mailer $swiftMailer,
        \Twig_Environment $twig,
        TokenGeneratorInterface $tokenGenerator
    ) {
        $this->swiftMailer = $swiftMailer;
        $this->twig = $twig;
        $this->tokenGenerator = $tokenGenerator;
    }

    /**
     * @param UserInterface $user
     *
     * @return UserInterface
     */
    public function generatePasswordAndActivateUser(UserInterface $user)
    {
        $user->setPlainPassword(substr($this->tokenGenerator->generateToken(), 0, 8));
        $user->setEnabled(true);

        return $user;
    }

    /**
     * Send registration confirmation mail.
     *
     * @param UserInterface $user
     */
    public function sendRegistrationConfirmationMail(UserInterface $user)
    {
        $body = $this->twig->render('@User/Email/loginConfirmation.html.twig', array(
            'user' => $user,
            'plainPassword' => $user->getPlainPassword()
        ));

        $this->sendMail('Registration confirmation', $user->getEmail(), $body);
    }

    /**
     * Send mail.
     *
     * @param string $subject
     * @param string $to
     * @param string $body
     */
    private function sendMail(string $subject, string $to, string $body)
    {
        $message = new \Swift_Message();

        $message
            ->setSubject($subject)
            ->setTo($to)
            ->setBody($body);

        $this->swiftMailer->send($message);
    }
}