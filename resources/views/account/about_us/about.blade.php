@extends('layouts.app')

@section('title', 'About & Contact - BookReview')

@section('main')
<div class="content-wrapper">
    <div class="container" style="margin-top: 10px">

        <!-- Hero Section -->
        <section class="hero-section"
            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 120px 0; text-align: center; position: relative; overflow: hidden;">
            <div class="hero-background"
                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: url('data:image/svg+xml,<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 1000 1000&quot;><polygon fill=&quot;%23ffffff10&quot; points=&quot;0,0 1000,300 1000,1000 0,700&quot;/></svg>'); background-size: cover;">
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center hero-content" style="position: relative; z-index: 2;">
                        <h1 class="hero-title"
                            style="font-size: 3.5rem; font-weight: 800; margin-bottom: 1.5rem; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); opacity: 0; transform: translateY(30px); animation: fadeInUp 0.8s ease forwards;">
                            About BookReview</h1>
                        <p class="hero-subtitle"
                            style="font-size: 1.3rem; margin-bottom: 2.5rem; opacity: 0.9; font-weight: 300; opacity: 0; transform: translateY(30px); animation: fadeInUp 0.8s ease forwards;">
                            Discover, Review, and Recommend the Best Books</p>
                        <div class="hero-buttons"
                            style="margin-top: 2rem; opacity: 0; transform: translateY(30px); animation: fadeInUp 0.8s ease forwards;">
                            <a href="#about" class="btn btn-light btn-lg me-3"
                                style="animation: pulse 2s infinite; transition: all 0.3s ease;">Learn More</a>
                            <a href="#contact" class="btn btn-outline-light btn-lg"
                                style="animation: pulse 2s infinite; transition: all 0.3s ease; color:black;">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="about-section" style="padding: 100px 0;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center mb-5">
                        <h2 class="section-title"
                            style="font-size: 2.8rem; font-weight: 700; margin-bottom: 1.5rem; color: #2c3e50; position: relative; opacity: 0; transform: translateX(-50px); animation: slideInLeft 0.8s ease forwards;">
                            Why Choose BookReview?</h2>
                        <p class="section-subtitle"
                            style="font-size: 1.2rem; color: #6c757d; margin-bottom: 3rem; line-height: 1.6; opacity: 0; transform: translateX(-50px); animation: slideInLeft 0.8s ease forwards;">
                            Your ultimate destination for book discovery and community-driven recommendations</p>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="feature-card"
                            style="background: white; padding: 2.5rem; border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); transition: all 0.4s ease; text-align: center; border: 1px solid rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); height: 100%; opacity: 0; transform: translateY(30px); animation: fadeInUp 0.8s ease forwards; animation-delay: 0.1s;">
                            <div class="feature-icon"
                                style="font-size: 3rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 1.5rem;">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <h3 class="feature-title"
                                style="font-size: 1.4rem; font-weight: 600; margin-bottom: 1rem; color: #2c3e50;">Vast
                                Book Library</h3>
                            <p class="feature-description" style="font-size: 1rem; color: #6c757d; line-height: 1.6;">
                                Access thousands of books across all genres. From bestsellers to hidden gems, find your
                                next great read.</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="feature-card"
                            style="background: white; padding: 2.5rem; border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); transition: all 0.4s ease; text-align: center; border: 1px solid rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); height: 100%; opacity: 0; transform: translateY(30px); animation: fadeInUp 0.8s ease forwards; animation-delay: 0.2s;">
                            <div class="feature-icon"
                                style="font-size: 3rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 1.5rem;">
                                <i class="fas fa-users"></i>
                            </div>
                            <h3 class="feature-title"
                                style="font-size: 1.4rem; font-weight: 600; margin-bottom: 1rem; color: #2c3e50;">
                                Community Reviews</h3>
                            <p class="feature-description" style="font-size: 1rem; color: #6c757d; line-height: 1.6;">
                                Read honest reviews from fellow book lovers and share your own thoughts to help others
                                discover great books.</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="feature-card"
                            style="background: white; padding: 2.5rem; border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); transition: all 0.4s ease; text-align: center; border: 1px solid rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); height: 100%; opacity: 0; transform: translateY(30px); animation: fadeInUp 0.8s ease forwards; animation-delay: 0.3s;">
                            <div class="feature-icon"
                                style="font-size: 3rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 1.5rem;">
                                <i class="fas fa-star"></i>
                            </div>
                            <h3 class="feature-title"
                                style="font-size: 1.4rem; font-weight: 600; margin-bottom: 1rem; color: #2c3e50;">Smart
                                Recommendations</h3>
                            <p class="feature-description" style="font-size: 1rem; color: #6c757d; line-height: 1.6;">
                                Get personalized book recommendations based on your reading history and preferences.</p>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-lg-6">
                        <div class="mission-card"
                            style="background: white; padding: 2.5rem; border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); transition: all 0.4s ease; height: 100%; position: relative; overflow: hidden; opacity: 0; transform: translateY(30px); animation: fadeInUp 0.8s ease forwards; animation-delay: 0.4s;">
                            <div
                                style="content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 5px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            </div>
                            <div class="mission-icon"
                                style="font-size: 2.5rem; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 1.5rem;">
                                <i class="fas fa-bullseye"></i>
                            </div>
                            <h3 class="mission-title"
                                style="font-size: 1.5rem; font-weight: 600; margin-bottom: 1rem; color: #2c3e50;">Our
                                Mission</h3>
                            <p class="mission-description" style="font-size: 1rem; color: #6c757d; line-height: 1.7;">At
                                BookReview, we believe that every book has the power to change lives. Our mission is to
                                create a vibrant community where readers can discover new books, share their
                                experiences, and connect with fellow book enthusiasts from around the world.</p>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="vision-card"
                            style="background: white; padding: 2.5rem; border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); transition: all 0.4s ease; height: 100%; position: relative; overflow: hidden; opacity: 0; transform: translateY(30px); animation: fadeInUp 0.8s ease forwards; animation-delay: 0.5s;">
                            <div
                                style="content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 5px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            </div>
                            <div class="vision-icon"
                                style="font-size: 2.5rem; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 1.5rem;">
                                <i class="fas fa-eye"></i>
                            </div>
                            <h3 class="vision-title"
                                style="font-size: 1.5rem; font-weight: 600; margin-bottom: 1rem; color: #2c3e50;">Our
                                Vision</h3>
                            <p class="vision-description" style="font-size: 1rem; color: #6c757d; line-height: 1.7;">We
                                envision a world where finding your next favorite book is as easy as clicking a button.
                                Through our platform, we aim to bridge the gap between readers and books, making
                                literature more accessible and enjoyable for everyone.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="stats-section"
            style="padding: 80px 0; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); position: relative; overflow: hidden;">
            <div class="stats-background"
                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: url('data:image/svg+xml,<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 1000 1000&quot;><circle fill=&quot;%23ffffff20&quot; cx=&quot;100&quot; cy=&quot;100&quot; r=&quot;50&quot;/><circle fill=&quot;%23ffffff15&quot; cx=&quot;300&quot; cy=&quot;200&quot; r=&quot;80&quot;/><circle fill=&quot;%23ffffff10&quot; cx=&quot;700&quot; cy=&quot;150&quot; r=&quot;60&quot;/></svg>');">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="stat-item"
                            style="text-align: center; padding: 2rem; position: relative; z-index: 2; opacity: 0; transform: translateY(30px); animation: fadeInUp 0.8s ease forwards; animation-delay: 0.1s;">
                            <div class="stat-number counter"
                                style="font-size: 3rem; font-weight: 800; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 0.5rem; transition: all 0.5s ease;"
                                data-target="10000">0</div>
                            <div class="stat-label" style="font-size: 1.1rem; color: #2c3e50; font-weight: 500;">Books
                                Available</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-item"
                            style="text-align: center; padding: 2rem; position: relative; z-index: 2; opacity: 0; transform: translateY(30px); animation: fadeInUp 0.8s ease forwards; animation-delay: 0.2s;">
                            <div class="stat-number counter"
                                style="font-size: 3rem; font-weight: 800; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 0.5rem; transition: all 0.5s ease;"
                                data-target="5000">0</div>
                            <div class="stat-label" style="font-size: 1.1rem; color: #2c3e50; font-weight: 500;">Active
                                Users</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-item"
                            style="text-align: center; padding: 2rem; position: relative; z-index: 2; opacity: 0; transform: translateY(30px); animation: fadeInUp 0.8s ease forwards; animation-delay: 0.3s;">
                            <div class="stat-number counter"
                                style="font-size: 3rem; font-weight: 800; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 0.5rem; transition: all 0.5s ease;"
                                data-target="25000">0</div>
                            <div class="stat-label" style="font-size: 1.1rem; color: #2c3e50; font-weight: 500;">Reviews
                                Written</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-item"
                            style="text-align: center; padding: 2rem; position: relative; z-index: 2; opacity: 0; transform: translateY(30px); animation: fadeInUp 0.8s ease forwards; animation-delay: 0.4s;">
                            <div class="stat-number counter"
                                style="font-size: 3rem; font-weight: 800; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 0.5rem; transition: all 0.5s ease;"
                                data-target="100">0</div>
                            <div class="stat-label" style="font-size: 1.1rem; color: #2c3e50; font-weight: 500;">Genres
                                Available</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="contact-section" style="padding: 100px 0;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center mb-5">
                        <h2 class="section-title"
                            style="font-size: 2.8rem; font-weight: 700; margin-bottom: 1.5rem; color: #2c3e50; position: relative; opacity: 0; transform: translateX(-50px); animation: slideInLeft 0.8s ease forwards;">
                            Get In Touch</h2>
                        <p class="section-subtitle"
                            style="font-size: 1.2rem; color: #6c757d; margin-bottom: 3rem; line-height: 1.6; opacity: 0; transform: translateX(-50px); animation: slideInLeft 0.8s ease forwards;">
                            Have questions or suggestions? We'd love to hear from you!</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8">
                        <div class="contact-card"
                            style="background: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); padding: 2.5rem; transition: all 0.4s ease; opacity: 0; transform: translateY(30px); animation: fadeInUp 0.8s ease forwards; animation-delay: 0.1s;">
                            <h3 class="mb-4">Send us a Message</h3>
                            <form class="contact-form">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control"
                                                style="border: 2px solid #e9ecef; border-radius: 10px; padding: 1rem; font-size: 1rem; transition: all 0.3s ease; background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px);"
                                                placeholder="Your Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <input type="email" class="form-control"
                                                style="border: 2px solid #e9ecef; border-radius: 10px; padding: 1rem; font-size: 1rem; transition: all 0.3s ease; background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px);"
                                                placeholder="Your Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control"
                                            style="border: 2px solid #e9ecef; border-radius: 10px; padding: 1rem; font-size: 1rem; transition: all 0.3s ease; background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px);"
                                            placeholder="Subject">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <textarea class="form-control"
                                            style="border: 2px solid #e9ecef; border-radius: 10px; padding: 1rem; font-size: 1rem; transition: all 0.3s ease; background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px);"
                                            rows="5" placeholder="Your Message"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary"
                                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 1rem 2rem; font-size: 1.1rem; font-weight: 600; border-radius: 50px; transition: all 0.3s ease; text-transform: uppercase; letter-spacing: 0.5px;">
                                    <i class="fas fa-paper-plane me-2"></i>Send Message
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="contact-info"
                            style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 20px; padding: 2.5rem; height: 100%; opacity: 0; transform: translateY(30px); animation: fadeInUp 0.8s ease forwards; animation-delay: 0.2s;">
                            <h3 class="mb-4">Contact Information</h3>

                            <div class="contact-item"
                                style="display: flex; align-items: flex-start; margin-bottom: 2rem; padding: 1rem; background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05); transition: all 0.3s ease;">
                                <div class="contact-icon"
                                    style="font-size: 1.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-right: 1rem; min-width: 40px;">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <h5 style="margin-bottom: 0.5rem; color: #2c3e50; font-weight: 600;">Address</h5>
                                    <p style="margin: 0; color: #6c757d;">123 Book Street, Literature City, Pakistan</p>
                                </div>
                            </div>

                            <div class="contact-item"
                                style="display: flex; align-items: flex-start; margin-bottom: 2rem; padding: 1rem; background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05); transition: all 0.3s ease;">
                                <div class="contact-icon"
                                    style="font-size: 1.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-right: 1rem; min-width: 40px;">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div>
                                    <h5 style="margin-bottom: 0.5rem; color: #2c3e50; font-weight: 600;">Phone</h5>
                                    <p style="margin: 0; color: #6c757d;">+92 300 1234567</p>
                                </div>
                            </div>

                            <div class="contact-item"
                                style="display: flex; align-items: flex-start; margin-bottom: 2rem; padding: 1rem; background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05); transition: all 0.3s ease;">
                                <div class="contact-icon"
                                    style="font-size: 1.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-right: 1rem; min-width: 40px;">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <h5 style="margin-bottom: 0.5rem; color: #2c3e50; font-weight: 600;">Email</h5>
                                    <p style="margin: 0; color: #6c757d;">info@bookreview.com</p>
                                </div>
                            </div>

                            <div class="contact-item"
                                style="display: flex; align-items: flex-start; margin-bottom: 2rem; padding: 1rem; background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05); transition: all 0.3s ease;">
                                <div class="contact-icon"
                                    style="font-size: 1.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-right: 1rem; min-width: 40px;">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div>
                                    <h5 style="margin-bottom: 0.5rem; color: #2c3e50; font-weight: 600;">Working Hours
                                    </h5>
                                    <p style="margin: 0; color: #6c757d;">Mon - Fri: 9AM - 6PM</p>
                                </div>
                            </div>

                            <div class="social-links"
                                style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid rgba(0, 0, 0, 0.1);">
                                <h5>Follow Us</h5>
                                <div class="social-icons" style="display: flex; gap: 1rem; margin-top: 1rem;">
                                    <a href="#" class="social-icon"
                                        style="width: 45px; height: 45px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.3s ease;"><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a href="#" class="social-icon"
                                        style="width: 45px; height: 45px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.3s ease;"><i
                                            class="fab fa-twitter"></i></a>
                                    <a href="#" class="social-icon"
                                        style="width: 45px; height: 45px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.3s ease;"><i
                                            class="fab fa-instagram"></i></a>
                                    <a href="#" class="social-icon"
                                        style="width: 45px; height: 45px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.3s ease;"><i
                                            class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<style>
    /* Animations */
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInLeft {
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }

        100% {
            transform: scale(1);
        }
    }

    /* Hover Effects */
    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .mission-card:hover,
    .vision-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .contact-card:hover {
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .contact-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .social-icon:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        color: white;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        background: white;
    }

    /* Section Title Underline */
    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 2px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem !important;
        }

        .hero-subtitle {
            font-size: 1.1rem !important;
        }

        .section-title {
            font-size: 2.2rem !important;
        }

        .feature-card,
        .mission-card,
        .vision-card {
            margin-bottom: 2rem;
        }

        .hero-buttons .btn {
            display: block;
            margin: 0.5rem 0;
        }
    }

    @media (max-width: 576px) {
        .hero-section {
            padding: 80px 0 !important;
        }

        .about-section,
        .contact-section {
            padding: 60px 0 !important;
        }

        .stats-section {
            padding: 50px 0 !important;
        }

        .hero-title {
            font-size: 2rem !important;
        }

        .section-title {
            font-size: 1.8rem !important;
        }

        .stat-number {
            font-size: 2.5rem !important;
        }
    }
</style>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Counter Animation
        const counters = document.querySelectorAll('.counter');
        const animateCounter = (counter) => {
            const target = parseInt(counter.getAttribute('data-target'));
            const increment = target / 100;
            let current = 0;
            
            const updateCounter = () => {
                if (current < target) {
                    current += increment;
                    counter.textContent = Math.floor(current).toLocaleString() + '+';
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target.toLocaleString() + '+';
                }
            };
            
            updateCounter();
        };
        
        // Intersection Observer for Counter Animation
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target.querySelector('.counter');
                    if (counter && !counter.classList.contains('animated')) {
                        counter.classList.add('animated');
                        animateCounter(counter);
                    }
                }
            });
        });
        
        document.querySelectorAll('.stat-item').forEach(item => {
            observer.observe(item);
        });
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Form submission (you can replace this with your actual form handling)
        document.querySelector('.contact-form').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add your form submission logic here
            alert('Thank you for your message! We will get back to you soon.');
        });
    });
</script>
@endsection