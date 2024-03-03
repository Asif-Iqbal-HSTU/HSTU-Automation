import { useState, useEffect } from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, usePage, Link, useForm } from '@inertiajs/react';

import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import NumberInput from '@/Components/NumberInput';
import TextArea from '@/Components/TextArea';

export default function CourseObjective({ message, auth }) {
    const { courseCode } = usePage().props;
    console.log(message);

    const { data, setData, post, processing, errors, reset } = useForm({
        CourseCode: '',
        CO_ID: '',
        CO_Description: '',
    });

    const submit = (e) => {
        e.preventDefault();
        post(route('course.store'));
    };


    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Add OBE Syllabus</h2>}
        >
            <Head title="Workspace" />


            {auth.user.role === "admin" ? (
                <>

                </>
            ) : (
                <>
                    <div className="py-12">
                        <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div className="p-6 text-gray-900 dark:text-gray-100">
                                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 flex justify-center">
                                        
                                        <div>
                                        <header>
                                            <h2 className="text-lg font-medium text-gray-900 dark:text-gray-100">Course Syllabus</h2>

                                            <p className="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                Add courses and syllabus from here.
                                            </p>
                                        </header>
                                            <form onSubmit={submit} className="mt-6 space-y-6">
                                                <div>
                                                    <InputLabel htmlFor="CourseCode" value="Course Code" />

                                                    <TextInput
                                                        id="CourseCode"
                                                        name="CourseCode"
                                                        value={data.CourseCode}
                                                        className="mt-1 block w-full"
                                                        autoComplete="CourseCode"
                                                        isFocused={true}
                                                        onChange={(e) => setData('CourseCode', e.target.value)}
                                                        required
                                                    />

                                                    <InputError message={errors.CourseCode} className="mt-2" />
                                                </div>

                                                <div>
                                                    <InputLabel htmlFor="CO_ID" value="Course Objective ID" />

                                                    <TextInput
                                                        id="CO_ID"
                                                        name="CO_ID"
                                                        value={data.CO_ID}
                                                        className="mt-1 block w-full"
                                                        autoComplete="CO_ID"
                                                        isFocused={true}
                                                        onChange={(e) => setData('CO_ID', e.target.value)}
                                                        required
                                                    />

                                                    <InputError message={errors.CO_ID} className="mt-2" />
                                                </div>

                                                <div>
                                                    <InputLabel htmlFor="CO_Description" value="Prerequisites" />

                                                    <TextArea
                                                        id="CO_Description"
                                                        name="CO_Description"
                                                        value={data.CO_Description}
                                                        className="mt-1 block w-full"
                                                        autoComplete="CO_Description"
                                                        onChange={(e) => setData('CO_Description', e.target.value)}
                                                        required
                                                    />

                                                    <InputError message={errors.CO_Description} className="mt-2" />
                                                </div>

                                                <div className="flex items-center justify-end mt-4">
                                                    <PrimaryButton className="ms-4" disabled={processing}>
                                                        Add Course Objective
                                                    </PrimaryButton>
                                                </div>
                                            </form>
                                        </div>
                                        <div>
                                            <p>Hello</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </>
            )}
        </AuthenticatedLayout >
    );
}