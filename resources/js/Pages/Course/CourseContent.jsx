import { useState } from 'react';
import { Inertia } from '@inertiajs/inertia';
import TextInput from '@/Components/TextInput';

export default function CourseContentForm() {
    const [content, setContent] = useState('');
    const [teachingStrategies, setTeachingStrategies] = useState([]);
    const [assessmentStrategies, setAssessmentStrategies] = useState([]);

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
        <form onSubmit={handleSubmit}>
            <div className="mb-4">
                <label htmlFor="content" className="block text-sm font-medium text-gray-700">
                    Content
                </label>
                <TextInput
                    id="content"
                    value={content}
                    onChange={(e) => setContent(e.target.value)}
                />
            </div>
            <div className="mb-4">
                <label className="block text-sm font-medium text-gray-700">Teaching Strategy</label>
                <div className="mt-1 space-y-2">
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
            <div className="mb-4">
                <label className="block text-sm font-medium text-gray-700">Assessment Strategy</label>
                <div className="mt-1 space-y-2">
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
            <div>
                <button type="submit" className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Save
                </button>
            </div>
        </form>
    );
}
