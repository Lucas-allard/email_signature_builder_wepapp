<?php

namespace App\Controller;

use App\Form\ForgottenPasswordRequestFormType;
use App\Form\ResetPasswordFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;

class LoginController extends AbstractController
{
    /**
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    #[Route('/connexion', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {

        $error = $authenticationUtils->getLastAuthenticationError();


        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    /**
     * @return void
     */
    #[Route('/logout', name: 'app_logout')]
    public function logout()
    {
    }

    /**
     * @throws TransportExceptionInterface
     */
    #[Route('/forgotten-password', name: 'app_forgot_password')]
    public function forgottenPassword(
        Request                 $request,
        UserRepository          $userRepository,
        TokenGeneratorInterface $tokenGenerator,
        EntityManagerInterface  $entityManager,
        MailerInterface         $mailer
    ): Response
    {
        $requestForm = $this->createForm(ForgottenPasswordRequestFormType::class);
        $requestForm->handleRequest($request);

        if ($requestForm->isSubmitted() && $requestForm->isValid()) {
            $user = $userRepository->findOneBy(['email' => $requestForm->get('email')->getData()]);
            if ($user) {
                $token = $tokenGenerator->generateToken();
                $user->setResetToken($token);
                $entityManager->persist($user);
                $entityManager->flush();

                $url = $this->generateUrl('app_reset_password', ['token' => $token], UrlGeneratorInterface::ABSOLUTE_URL);

                $message = (new TemplatedEmail())
                    ->from('noreply@entreprise.mili-atlas.fr')
                    ->to($user->getEmail())
                    ->subject('Mot de passe oublié')
                    ->htmlTemplate('emails/forgotten_password.html.twig')
                    ->context([
                        'url' => $url,
                    ]);


                $mailer->send($message);

                $this->addFlash('success', 'Mail envoyé');

                return $this->redirectToRoute('app_login');
            }

            $this->addFlash('danger', 'Vous de possédez pas de compte');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('login/forgotten_password_request.html.twig', [
            'requestForm' => $requestForm->createView(),
        ]);
    }

    #[Route('/reset-password/{token}', name: 'app_reset_password')]
    public function resetPassword(
        string                 $token,
        Request                $request,
        UserRepository         $userRepository,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher
    ): Response
    {
        $user = $userRepository->findOneBy(['resetToken' => $token]);
        if (!$user) {
            $this->addFlash('danger', 'Token Inconnu');
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createForm(ResetPasswordFormType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setResetToken(null);
            $user->setPassword($passwordHasher->hashPassword($user, $form->get('password')->getData()));
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Mot de passe mis à jour');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('login/reset_password.html.twig', [
            'token' => $token,
            'resetForm' => $form->createView(),
        ]);
    }
}