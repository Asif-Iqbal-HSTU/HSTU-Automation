import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Link, Head } from '@inertiajs/react';
import PrimaryButton from '@/Components/PrimaryButton';
import ExtraButton from '@/Components/PrimaryButton';

export default function Dashboard({ auth }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>}
        >
            <Head title="Dashboard" />


            <div className="max-w-7xl mx-auto p-6 lg:p-8">               
                <div className="mt-16">
                    <div className="grid grid-cols-1 md:grid-cols-1 gap-6 lg:gap-8 flex justify-center">
                        <div className="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                            <div>
                                <div className="h-14 w-14 bg-green-800/20 dark:bg-white-1200/100 flex items-center justify-center rounded-full">
                                    <img src="./images/digital.svg" alt="Description of the image" />
                                </div>

                                <h2 className="mt-6 text-xl font-semibold text-gray-900 dark:text-white">
                                    Welcome To Automation System of HSTU
                                </h2>

                                <p className="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                    Welcome to HSTU's Automation System! Streamlining processes, enhancing communication, and simplifying your university experience. Explore, engage, and enjoy your journey with us!
                                </p>
                                <div className="flex items-center gap-4 mt-4">

                                    {auth.user ? (
                                        <Link
                                            href={route('workspace')}>
                                            <PrimaryButton>
                                                Workspace
                                            </PrimaryButton>
                                        </Link>
                                    ) : (
                                        <>
                                        </>
                                    )}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </AuthenticatedLayout>
    );
}
