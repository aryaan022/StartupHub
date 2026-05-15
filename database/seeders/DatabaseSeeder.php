<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Startup;
use App\Models\Job;
use App\Models\Investor;
use App\Models\JobSeekerProfile;
use App\Models\UserSkill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test users - Founders
        $founder1 = User::create([
            'first_name' => 'John',
            'last_name' => 'Smith',
            'email' => 'john@startup.com',
            'password' => Hash::make('password'),
            'role' => 'founder',
            'email_verified_at' => now(),
        ]);

        $founder2 = User::create([
            'first_name' => 'Sarah',
            'last_name' => 'Johnson',
            'email' => 'sarah@startup.com',
            'password' => Hash::make('password'),
            'role' => 'founder',
            'email_verified_at' => now(),
        ]);

        // Create test users - Investors
        $investor1 = User::create([
            'first_name' => 'Michael',
            'last_name' => 'Chen',
            'email' => 'michael@ventures.com',
            'password' => Hash::make('password'),
            'role' => 'investor',
            'email_verified_at' => now(),
        ]);

        $investor2 = User::create([
            'first_name' => 'Emma',
            'last_name' => 'Wilson',
            'email' => 'emma@ventures.com',
            'password' => Hash::make('password'),
            'role' => 'investor',
            'email_verified_at' => now(),
        ]);

        // Create test users - Job Seekers
        $jobSeeker1 = User::create([
            'first_name' => 'Alex',
            'last_name' => 'Rivera',
            'email' => 'alex@student.com',
            'password' => Hash::make('password'),
            'role' => 'job_seeker',
            'email_verified_at' => now(),
        ]);

        $jobSeeker2 = User::create([
            'first_name' => 'Maria',
            'last_name' => 'Garcia',
            'email' => 'maria@student.com',
            'password' => Hash::make('password'),
            'role' => 'job_seeker',
            'email_verified_at' => now(),
        ]);

        // Create Startups
        $startup1 = Startup::create([
            'founder_id' => $founder1->id,
            'name' => 'TechFlow AI',
            'slug' => 'techflow-ai',
            'description' => 'AI-powered workflow automation platform for enterprises',
            'short_description' => 'Automate enterprise workflows with AI',
            'website_url' => 'https://techflow.ai',
            'logo_url' => 'https://via.placeholder.com/200?text=TechFlow',
            'industry' => 'Artificial Intelligence',
            'stage' => 'series_a',
            'founded_at' => now()->subMonths(18)->toDateString(),
            'team_size' => 25,
            'is_hiring' => true,
            'is_verified' => true,
        ]);

        $startup2 = Startup::create([
            'founder_id' => $founder2->id,
            'name' => 'EcoMarket',
            'slug' => 'ecomarket',
            'description' => 'Sustainable e-commerce marketplace connecting eco-conscious brands',
            'short_description' => 'Shop sustainable products from conscious brands',
            'website_url' => 'https://ecomarket.io',
            'logo_url' => 'https://via.placeholder.com/200?text=EcoMarket',
            'industry' => 'E-commerce',
            'stage' => 'seed',
            'founded_at' => now()->subMonths(8)->toDateString(),
            'team_size' => 8,
            'is_hiring' => true,
            'is_verified' => false,
        ]);

        // Create Investors
        $investorProfile1 = Investor::create([
            'user_id' => $investor1->id,
            'company_name' => 'Venture Capital Partners',
            'company_description' => 'We invest in innovative tech companies solving real problems',
            'investment_range_min' => 100000,
            'investment_range_max' => 5000000,
            'verified' => true,
            'industries' => json_encode(['AI', 'SaaS', 'B2B']),
            'stages' => json_encode(['seed', 'series_a', 'series_b']),
        ]);

        $investorProfile2 = Investor::create([
            'user_id' => $investor2->id,
            'company_name' => 'Green Impact Fund',
            'company_description' => 'Funding the future of sustainable business',
            'investment_range_min' => 50000,
            'investment_range_max' => 2000000,
            'verified' => true,
            'industries' => json_encode(['Sustainability', 'ClimTech', 'Green Energy']),
            'stages' => json_encode(['seed', 'series_a']),
        ]);

        // Create Job Seeker Profiles
        $profile1 = JobSeekerProfile::create([
            'user_id' => $jobSeeker1->id,
            'headline' => 'Full Stack Developer | Laravel & React Expert',
            'bio' => 'Experienced full-stack developer with 5 years in startup environments',
            'resume_url' => 'https://via.placeholder.com/100?text=Resume1',
            'portfolio_url' => 'https://alexrivera.dev',
            'github_url' => 'https://github.com/alexrivera',
            'years_experience' => 5,
            'current_job_title' => 'Lead Developer',
            'current_company' => 'Tech Startup Inc',
            'is_open_to_opportunities' => true,
            'preferred_job_types' => json_encode(['full_time', 'contract']),
            'preferred_locations' => json_encode(['San Francisco', 'Remote']),
            'skills' => json_encode(['PHP', 'Laravel', 'React', 'PostgreSQL']),
        ]);

        $profile2 = JobSeekerProfile::create([
            'user_id' => $jobSeeker2->id,
            'headline' => 'Marketing Enthusiast | Recent Graduate',
            'bio' => 'Recent graduate passionate about sustainable technology and marketing',
            'resume_url' => 'https://via.placeholder.com/100?text=Resume2',
            'portfolio_url' => 'https://mariagarcia.portfolio',
            'years_experience' => 1,
            'is_open_to_opportunities' => true,
            'preferred_job_types' => json_encode(['full_time', 'internship']),
            'preferred_locations' => json_encode(['New York', 'Remote']),
            'skills' => json_encode(['Social Media Marketing', 'Content Creation', 'Analytics']),
        ]);

        // Add skills to job seekers
        UserSkill::create([
            'user_id' => $jobSeeker1->id,
            'skill_name' => 'PHP',
            'proficiency_level' => 'expert',
            'years_of_experience' => 5,
        ]);

        UserSkill::create([
            'user_id' => $jobSeeker1->id,
            'skill_name' => 'React',
            'proficiency_level' => 'advanced',
            'years_of_experience' => 4,
        ]);

        UserSkill::create([
            'user_id' => $jobSeeker1->id,
            'skill_name' => 'Laravel',
            'proficiency_level' => 'expert',
            'years_of_experience' => 5,
        ]);

        UserSkill::create([
            'user_id' => $jobSeeker2->id,
            'skill_name' => 'Digital Marketing',
            'proficiency_level' => 'intermediate',
            'years_of_experience' => 1,
        ]);

        UserSkill::create([
            'user_id' => $jobSeeker2->id,
            'skill_name' => 'Social Media Management',
            'proficiency_level' => 'advanced',
            'years_of_experience' => 2,
        ]);

        // Create Jobs
        $job1 = Job::create([
            'startup_id' => $startup1->id,
            'created_by_id' => $founder1->id,
            'title' => 'Senior Full Stack Developer',
            'slug' => 'senior-full-stack-developer',
            'description' => 'We are looking for an experienced full stack developer to lead our platform development. You will work with Laravel and React to build scalable solutions.',
            'requirements' => 'At least 5 years of experience with PHP/Laravel and React',
            'benefits' => 'Health Insurance, Stock Options, Remote Option',
            'job_type' => 'full_time',
            'experience_level' => 'senior',
            'salary_min' => 140000,
            'salary_max' => 180000,
            'salary_currency' => 'USD',
            'location' => 'San Francisco, CA',
            'remote_type' => 'hybrid',
            'skills_required' => json_encode(['PHP', 'Laravel', 'React', 'PostgreSQL']),
            'is_active' => true,
        ]);

        $job2 = Job::create([
            'startup_id' => $startup1->id,
            'created_by_id' => $founder1->id,
            'title' => 'DevOps Engineer',
            'slug' => 'devops-engineer',
            'description' => 'Help us scale our infrastructure. Experience with Kubernetes, Docker, and AWS required. Join our growing team!',
            'requirements' => 'Experience with Kubernetes, Docker, AWS and Python scripting',
            'benefits' => 'Flexible Hours, Remote Work, Professional Development',
            'job_type' => 'full_time',
            'experience_level' => 'mid',
            'salary_min' => 130000,
            'salary_max' => 160000,
            'salary_currency' => 'USD',
            'location' => 'Remote',
            'remote_type' => 'remote',
            'skills_required' => json_encode(['Kubernetes', 'Docker', 'AWS', 'Python']),
            'is_active' => true,
        ]);

        $job3 = Job::create([
            'startup_id' => $startup2->id,
            'created_by_id' => $founder2->id,
            'title' => 'Marketing Coordinator',
            'slug' => 'marketing-coordinator',
            'description' => 'Help us grow EcoMarket! We need a creative marketing coordinator to manage our social media and campaigns.',
            'requirements' => 'Experience with social media platforms and content creation',
            'benefits' => 'Learning Opportunities, Startup Equity, Flexible Schedule',
            'job_type' => 'full_time',
            'experience_level' => 'entry',
            'salary_min' => 55000,
            'salary_max' => 70000,
            'salary_currency' => 'USD',
            'location' => 'New York, NY',
            'remote_type' => 'hybrid',
            'skills_required' => json_encode(['Social Media', 'Content Creation', 'Analytics']),
            'is_active' => true,
        ]);

        $job4 = Job::create([
            'startup_id' => $startup2->id,
            'created_by_id' => $founder2->id,
            'title' => 'Product Development Internship',
            'slug' => 'internship-product-development',
            'description' => 'Join us for a 3-month internship working on real products. Great opportunity to learn in a fast-paced startup environment.',
            'requirements' => 'Passion, Learning Ability, Communication',
            'benefits' => 'Mentorship, Real Experience, Potential Conversion',
            'job_type' => 'internship',
            'experience_level' => 'entry',
            'salary_min' => 2500,
            'salary_max' => 4000,
            'salary_currency' => 'USD',
            'location' => 'New York, NY',
            'remote_type' => 'onsite',
            'skills_required' => json_encode(['Communication', 'Learning']),
            'is_active' => true,
        ]);

        \App\Models\JobApplication::create([
            'job_id' => $job1->id,
            'applicant_id' => $jobSeeker1->id,
            'startup_id' => $startup1->id,
            'cover_letter' => 'I am very interested in this position. I have extensive experience with the tech stack mentioned and have worked on similar scaling challenges.',
            'status' => 'applied',
        ]);

        \App\Models\Investment::create([
            'investor_id' => $investorProfile1->id,
            'startup_id' => $startup1->id,
            'amount' => 500000,
            'currency' => 'USD',
            'investment_type' => 'venture',
            'equity_percentage' => 5,
            'status' => 'completed',
            'invested_at' => now()->subMonths(6),
        ]);

        \App\Models\Watchlist::create([
            'investor_id' => $investorProfile2->id,
            'startup_id' => $startup2->id,
            'added_at' => now(),
        ]);
    }
}
