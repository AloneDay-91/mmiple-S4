<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Twig\Environment; // Assurez-vous d'importer cette classe

class MailerService
{
    private MailerInterface $mailer;
    private Environment $twig;

    // Ajoutez le paramètre MailerInterface dans le constructeur
    public function __construct(MailerInterface $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function sendEmail(string $expediteur, string $sujet, string $message): void
    {
        // Utilisation de TemplatedEmail pour un email simple
        $email = (new TemplatedEmail())
            ->from('contact@mmiple.fr')
            ->replyTo($expediteur)
            ->to('administrateur@mmiple.fr')
            ->subject($sujet)
            ->text($message);

        try {
            $this->mailer->send($email);
        } catch (\Exception $e) {
            // Loger l'erreur ou gérer l'exception
            throw new \RuntimeException('Erreur lors de l\'envoi de l\'email : ' . $e->getMessage());
        }
    }

    public function sendTemplateEmail(string $destinataire, string $sujet, string $template, array $data = []): void
    {
        // Utilisation de Twig pour rendre le template
        $htmlContent = $this->twig->render('mails/'.$template, $data); // Charge et rend le template avec les données

        $email = (new TemplatedEmail())
            ->from('contact@mmiple.fr')
            ->to($destinataire)
            ->subject($sujet)
            ->html($htmlContent); // Envoie le contenu HTML généré par Twig

        try {
            $this->mailer->send($email);
        } catch (\Exception $e) {
            // Loger l'erreur ou gérer l'exception
            throw new \RuntimeException('Erreur lors de l\'envoi de l\'email : ' . $e->getMessage());
        }
    }
}
