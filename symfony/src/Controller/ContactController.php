<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    public const CONTACT_EMAIL = 'kontakt@moje-domena.local';

    #[Route('/kontakt', name: 'app_contact')]
    public function create(Request $request, MailerInterface $mailer): Response
    {
        $contactForm = $this->createForm(ContactType::class);

        $contactForm->handleRequest($request);
        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            $name = $contactForm->get('name')->getData();
            $userEmail = $contactForm->get('email')->getData();
            $message = $contactForm->get('message')->getData();

            $email = new Email();
            $email->from($userEmail)
                ->to(self::CONTACT_EMAIL)
                ->subject('Zpráva z kontaktního formuláře')
                ->html("<p>Od: $name</p><p>$message</p>");

            try {
                $mailer->send($email);
                $this->addFlash('success', 'Zpráva byla úspěšně odeslána.');
                return $this->redirectToRoute('app_contact');
            } catch (TransportExceptionInterface $e) {
                $this->addFlash('error', 'Zprávu se nepodařilo odeslat, prosím zkuste to znovu.');
            }
        }

        if ($contactForm->isSubmitted() && !$contactForm->isValid()) {
            $this->addFlash('error', 'Zprávu se nepodařilo odeslat. Zkontrojte správnost vyplnených informací.');
        }


        return $this->render('contact/create.html.twig', [
            'contact_form' => $contactForm,
        ]);
    }
}
