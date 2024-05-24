<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;
use App\Http\Controllers\Controller;
use BotMan\BotMan\Messages\Attachments\Image;

use BotMan\BotMan\Messages\Outgoing\Actions\Button;

class BotManController extends Controller
{
    protected $faqs = [
        'General Questions' => [
            "What is ArtNexus?",
            "Who can join ArtNexus?",
            "How can I contact customer support?",
            "What are the benefits of joining ArtNexus?",
        ],
        'For Artists' => [
            "How do I sign up as an artist on ArtNexus?",
            "What types of art can I showcase on ArtNexus?",
            "How does the advanced product management system work?",
            "Can I sell prints of my artwork?",
            "How do I price my artworks?",
        ],
        'For Art Enthusiasts' => [
            "How do I purchase artwork on ArtNexus?",
            "Can I communicate directly with artists?",
            "How can I leave a review for a purchased artwork?",
            "Are there any membership fees for art enthusiasts?",
            "How do I create a wishlist?",
        ],
        'Security and Trust' => [
            "Is my personal information safe on ArtNexus?",
            "How does ArtNexus ensure the authenticity of the artwork?",
            "What is ArtNexus' refund policy?",
            "How do I report a fraudulent seller or listing?",
        ]
    ];

    protected $faqAnswers = [
        "What is ArtNexus?" => "ArtNexus is a dynamic online art gallery designed to connect artists with art enthusiasts. It provides a platform for showcasing, buying, and selling a diverse range of artworks, including paintings, sculptures, digital art, and more.",
        "Who can join ArtNexus?" => "ArtNexus is open to all artists, art collectors, and enthusiasts. Whether you are a professional artist, an amateur, or simply someone who loves art, ArtNexus has something to offer you.",
        "How can I contact customer support?" => "You can contact our customer support team by clicking on the 'Contact Us' link at the bottom of the homepage. We offer support via email, phone, and live chat.",
        "What are the benefits of joining ArtNexus?" => "Members of ArtNexus can enjoy exclusive access to new artwork releases, personalized recommendations, and direct communication with artists. Artists benefit from a robust platform to showcase and sell their work to a global audience.",
        "How do I sign up as an artist on ArtNexus?" => "Simply click on the 'Sign Up' button on our homepage, select 'Artist' as your user role, and fill in the required information. Once your account is verified, you can start uploading your artworks.",
        "What types of art can I showcase on ArtNexus?" => "You can showcase various forms of art, including paintings, sculptures, drawings, photography, printmaking, digital art, textile art, and fiber art.",
        "How does the advanced product management system work?" => "Our advanced product management system allows you to upload multiple images of your artwork, manage product variants, and categorize your art for easy navigation. It also provides tools for pricing, descriptions, and inventory management.",
        "Can I sell prints of my artwork?" => "Yes, ArtNexus allows you to sell both original artworks and high-quality prints. Make sure to specify in your product description whether the piece is an original or a print.",
        "How do I price my artworks?" => "Pricing your artwork depends on factors such as the cost of materials, the time spent creating the piece, and market trends. We recommend researching similar artworks on ArtNexus and considering these factors when setting your prices.",
        "How do I purchase artwork on ArtNexus?" => "Browse through the artwork categories or use the search function to find specific pieces. Once you find something you love, click 'Buy Now' and follow the secure checkout process using our integrated payment gateways.",
        "Can I communicate directly with artists?" => "Yes, ArtNexus offers a real-time messaging system that allows you to communicate directly with artists. You can ask questions, discuss commissions, and learn more about the artwork.",
        "How can I leave a review for a purchased artwork?" => "After receiving your artwork, navigate to your order history and select the piece you want to review. Click on 'Leave a Review,' rate the artwork, and write your comments. Your feedback helps other buyers and supports artists.",
        "Are there any membership fees for art enthusiasts?" => "No, there are no membership fees for art enthusiasts on ArtNexus. You can browse and purchase artworks without any additional costs.",
        "How do I create a wishlist?" => "To create a wishlist, simply click the 'Add to Wishlist' button on any artwork page. You can view and manage your wishlist from your account dashboard.",
        "Is my personal information safe on ArtNexus?" => "Absolutely. ArtNexus uses robust encryption protocols and strong authentication mechanisms to ensure your personal information and financial transactions are secure.",
        "How does ArtNexus ensure the authenticity of the artwork?" => "We have a thorough verification process for artists, and we encourage artists to provide provenance details for their artworks. Additionally, our community reviews and ratings help maintain trust and authenticity on the platform.",
        "What is ArtNexus' refund policy?" => "ArtNexus offers a 14-day return policy for all purchases. If you are not satisfied with your purchase, you can request a return within 14 days of receiving the artwork. The artwork must be in its original condition.",
        "How do I report a fraudulent seller or listing?" => "If you suspect a fraudulent seller or listing, please report it immediately by clicking the 'Report' button on the listing page. Our team will investigate and take appropriate action."
    ];

    /**
     * Main handler for BotMan messages.
     */
    public function handle()
    {
        $botman = app('botman');

        // Set up the hearing patterns
        //$botman->ask('Start a conversation by saying hi.');
        $botman->hears('hello', function($botman) {
            $this->askName($botman);
        });
        $botman->hears('hi', function($botman) {
            $this->askName($botman);
        });
        $botman->hears('hey', function($botman) {
            $this->askName($botman);
        });


        $botman->hears('help', function($botman) {
            $this->provideAssistance($botman);
        });

        // $botman->hears('faq', function($botman) {
        //     $this->faq($botman);
        // });


        $botman->hears('contact', function (BotMan $bot) {
            $this->contactInfo($bot);
        });

        $botman->hears('hours|contact hours', function (BotMan $bot) {
            $this->openingHours($bot);
        });

        $botman->hears('services', function (BotMan $bot) {
            $this->services($bot);
        });

        $botman->hears('location|address', function (BotMan $bot) {
            $this->locationInfo($bot);
        });
        $botman->hears('payment', function (BotMan $bot) {
            $this->paymentmethods($bot);
        });

        $botman->hears('subscribe', function (BotMan $bot) {
            $this->newsletterSubscription($bot);
        });

        $botman->hears('refund', function (BotMan $bot) {
            $this->refundPolicy($bot);
        });

        $botman->hears('delivery', function (BotMan $bot) {
            $this->deliveryInformation($bot);
        });
        $botman->hears('track', function (BotMan $bot) {
            $this->trackorder($bot);
        });

        $botman->hears('order', function($botman) {
            $this->placeOrder($botman);
        });

        // Fallback for unrecognized input
        $botman->fallback(function($botman) {
            $botman->reply("I'm sorry, I didn't understand that. Type 'help' for assistance.");
        });

        $botman->listen();
    }

    /**
     * Ask for the user's name and respond with a greeting.
     */
    public function askName($botman)
    {
        $botman->ask('Hello! What is your name?', function(Answer $answer, $botman) {
            $name = $answer->getText();
            $botman->say('Nice to meet you, '.$name.'. How can I assist you today?');
        });
    }

    /**
     * Provide a list of assistance options to the user.
     */
    public function provideAssistance($botman)
    {
        $botman->reply('Sure, I can help you with the following options: <br>- To place an order, type "order". <br>
        - To contact us, type "contact". <br>
        - To know our opening hours, type "hours" or "contact hours". <br>
        - To learn about our services, type "services". <br>
        - For our location or address, type "location" or "address". <br>
        - For payment methods, type "payment". <br>
        - To subscribe to our newsletter, type "subscribe". <br>
        - For our refund policy, type "refund". <br>
        - For delivery information, type "delivery". <br>
        - To track your order, type "track". <br>
        - For any other assistance, feel free to ask. ');
    }

    /**
     * Guide the user through placing an order.
     */
    public function placeOrder($botman)
    {
        $botman->reply('To place an order, follow the steps below: <br> - Please add the artworks you want to buy to your cart. <br> - Open the cart and click on checkout. <br> - Select preffered shipping details like address and methods. <br> - Select pffereed payment method and pay. <Br> - Sit back and relax. We will process your order.');

    }

    public function contactInfo(BotMan $bot)
    {
        $bot->reply("You can contact us at:
        \nEmail: support@artnexus.com
        \nPhone: +1234567890");
    }

    public function openingHours(BotMan $bot)
    {
        $bot->reply("Our contact hours are:
        <br> Monday to Friday: 9 AM - 6 PM
        <br> Saturday: 10 AM - 4 PM
        <br> Sunday: Closed");
    }

    public function services(BotMan $bot)
    {
        $bot->reply("At ArtNexus, we offer the following services:
        <br> 1. Online art sales
        <br> 2. Art Consultancy
        <br> 3. Artwork selling platform
        <br> 4. Custom art commissions");
    }

    public function locationInfo(BotMan $bot)
    {

        $bot->reply("We are located at:
        <br> Usha Mittal Institute of Technology, SNDT University, Santacruz-west, Mumbai, 400049");
    }


    public function newsletterSubscription(BotMan $bot)
    {
        $bot->reply("Subscribe to our newsletter for the latest updates and offers:
        <br> Please visit our website and enter your email address in the subscription box at the bottom of the page.");
    }

    public function refundPolicy(BotMan $bot)
    {
        $bot->reply("Our Refund Policy:
        <br> We offer a 30-day money-back guarantee on all purchases. <br> If you are not satisfied with your purchase, <br> please contact our support team for assistance.");
    }

    public function deliveryInformation(BotMan $bot)
    {
        $bot->reply("Delivery Information:
            <br> We offer worldwide shipping with an estimated delivery time of 5-10 business days. <br> All orders are processed within 2-3 business days. <br> ");
    }
    public function trackorder(BotMan $bot)
    {
        $bot->reply("Track Your Order:
            <br> - Click on 'Track order' button on homepage. <br> - Enter your order ID (You can copy it from invoice or simply from your dashboard. <br> - click on 'Track'. <br> - Visualized tracking details will be displayed. ");
    }
    public function paymentmethods(BotMan $bot)
    {
        $bot->reply("We offer Multiple payment options:
            <br> - PayPal <br> - Stripe (Intenational users)  <br> - Razorpay (UPI, EMI, card, etc multiple methods available.)  <br> - Cash on delivery ");
    }


    // public function faq(BotMan $botman)
    // {
    //     // Get the list of FAQ sections
    //     $faqSections = array_keys($this->faqs);

    //     // Create a numbered list of sections
    //     $faqText = "Please choose a section by typing its number: <br>";
    //     foreach ($faqSections as $index => $section) {
    //         $faqText .= ($index + 1) . ". " . $section . " <br>";
    //     }

    //     // Ask the user to select a section
    //     $askQuestion = function (Answer $answer) use ($faqSections, $botman) {
    //         $selectedSection = null;
    //         $sectionNumber = (int) $answer->getText();

    //         switch ($sectionNumber) {
    //             case 1:
    //                 $selectedSection = 'General Questions';
    //                 break;
    //             case 2:
    //                 $selectedSection = 'For Artists';
    //                 break;
    //             case 3:
    //                 $selectedSection = 'For Art Enthusiasts';
    //                 break;
    //             case 4:
    //                 $selectedSection = 'Security and Trust';
    //                 break;
    //             default:
    //                 $botman->reply("Invalid selection. Please type a number corresponding to the section.");
    //                 return; // Exit the function if the selection is invalid
    //         }

    //         // Display the FAQs for the selected section
    //         $this->showFaqSection($botman, $selectedSection);
    //     };

    //     // Ask the user the FAQ question
    //     $botman->ask($faqText, $askQuestion);
    // }

    // public function showFaqSection(BotMan $botman, $section)
    // {
    //     // Initialize an empty string to store the FAQ text
    //     $faqText = "FAQs for {$section}:\n";

    //     // Switch statement to handle each section
    //     switch ($section) {
    //         case 'General Questions':
    //             $faqText .= "1. What is ArtNexus?\n";
    //             $faqText .= "2. Who can join ArtNexus?\n";
    //             $faqText .= "3. How can I contact customer support?\n";
    //             $faqText .= "4. What are the benefits of joining ArtNexus?\n";
    //             break;
    //         case 'For Artists':
    //             $faqText .= "1. How do I sign up as an artist on ArtNexus?\n";
    //             $faqText .= "2. What types of art can I showcase on ArtNexus?\n";
    //             $faqText .= "3. How does the advanced product management system work?\n";
    //             $faqText .= "4. Can I sell prints of my artwork?\n";
    //             $faqText .= "5. How do I price my artworks?\n";
    //             break;
    //         case 'For Art Enthusiasts':
    //             $faqText .= "1. How do I purchase artwork on ArtNexus?\n";
    //             $faqText .= "2. Can I communicate directly with artists?\n";
    //             $faqText .= "3. How can I leave a review for a purchased artwork?\n";
    //             $faqText .= "4. Are there any membership fees for art enthusiasts?\n";
    //             $faqText .= "5. How do I create a wishlist?\n";
    //             break;
    //         case 'Security and Trust':
    //             $faqText .= "1. Is my personal information safe on ArtNexus?\n";
    //             $faqText .= "2. How does ArtNexus ensure the authenticity of the artwork?\n";
    //             $faqText .= "3. What is ArtNexus' refund policy?\n";
    //             $faqText .= "4. How do I report a fraudulent seller or listing?\n";
    //             break;
    //         default:
    //             $botman->reply("Invalid section.");
    //             return; // Exit the function if the section is invalid
    //     }

    //     // Send the FAQ text as a reply
    //     $botman->reply(nl2br($faqText)); // Use nl2br for newlines in HTML
    // }

    // /**
    //  * Display the answer for the selected FAQ.
    //  */
    // public function showFaqAnswer(BotMan $botman, $faq)
    // {
    //     if (isset($this->faqAnswers[$faq])) {
    //         $answer = $this->faqAnswers[$faq];
    //         $botman->reply($faq . "\n" . $answer);
    //     } else {
    //         $botman->reply("Sorry, I don't have an answer for that question.");
    //     }
    // }
}
