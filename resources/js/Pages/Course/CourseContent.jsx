import { Inertia } from '@inertiajs/inertia';
import TextInput from '@/Components/TextInput';
import { useState, useEffect } from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, usePage, Link, useForm } from '@inertiajs/react';

import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import NumberInput from '@/Components/NumberInput';
import TextArea from '@/Components/TextArea';

export default function CourseContentForm({ message, auth }) {
    const [content, setContent] = useState('');
    const [teachingStrategies, setTeachingStrategies] = useState([]);
    const [assessmentStrategies, setAssessmentStrategies] = useState([]);

    const { data, setData, post, processing, errors, reset } = useForm({
        content: '',
        teaching_strategy: '',
        assessment_strategy: '',
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        const formData = {
            content: content,
            teaching_strategy: teachingStrategies.join(', '),
            assessment_strategy: assessmentStrategies.join(', ')
        };
        Inertia.post(route('coursecontent.upload'), formData);
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Add OBE Syllabus</h2>}
        >

            <Head title="Workspace" />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            <header>
                                <h2 className="text-lg font-medium text-gray-900 dark:text-gray-100">Course Syllabus</h2>
                                <p className="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    Add courses and syllabus from here.
                                </p>
                            </header>
                            <form onSubmit={handleSubmit} className="mt-6 space-y-6">
                                <div>
                                    <InputLabel htmlFor="content" value="Content" />
                                    <TextArea
                                        id="content"
                                        value={content}
                                        onChange={(e) => setContent(e.target.value)}
                                        required
                                    />
                                    <InputError message={errors.content} className="mt-2" />
                                </div>
                                <div>
                                    <InputLabel value="Teaching Strategy" />
                                    <div className="mt-2 space-y-2">
                                        <label className="inline-flex items-center">
                                            <input type="checkbox" className="form-checkbox" value="Lecture" onChange={(e) => e.target.checked ? setTeachingStrategies([...teachingStrategies, e.target.value]) : setTeachingStrategies(teachingStrategies.filter(strategy => strategy !== e.target.value))} />
                                            <span className="ml-2">Lecture</span>
                                        </label>
                                        <label className="inline-flex items-center">
                                            <input type="checkbox" className="form-checkbox" value="Demonstration" onChange={(e) => e.target.checked ? setTeachingStrategies([...teachingStrategies, e.target.value]) : setTeachingStrategies(teachingStrategies.filter(strategy => strategy !== e.target.value))} />
                                            <span className="ml-2">Demonstration</span>
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <InputLabel value="Assessment Strategy" />
                                    <div className="mt-2 space-y-2">
                                        <label className="inline-flex items-center">
                                            <input type="checkbox" className="form-checkbox" value="MCQ" onChange={(e) => e.target.checked ? setAssessmentStrategies([...assessmentStrategies, e.target.value]) : setAssessmentStrategies(assessmentStrategies.filter(strategy => strategy !== e.target.value))} />
                                            <span className="ml-2">MCQ</span>
                                        </label>
                                        <label className="inline-flex items-center">
                                            <input type="checkbox" className="form-checkbox" value="Quiz" onChange={(e) => e.target.checked ? setAssessmentStrategies([...assessmentStrategies, e.target.value]) : setAssessmentStrategies(assessmentStrategies.filter(strategy => strategy !== e.target.value))} />
                                            <span className="ml-2">Quiz</span>
                                        </label>
                                        <label className="inline-flex items-center">
                                            <input type="checkbox" className="form-checkbox" value="Assignment" onChange={(e) => e.target.checked ? setAssessmentStrategies([...assessmentStrategies, e.target.value]) : setAssessmentStrategies(assessmentStrategies.filter(strategy => strategy !== e.target.value))} />
                                            <span className="ml-2">Assignment</span>
                                        </label>
                                    </div>
                                </div>
                                <div className="flex items-center justify-end mt-4">
                                    <PrimaryButton className="ms-4" type="submit">
                                        Add Course Content
                                    </PrimaryButton>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
