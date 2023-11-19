import { useEffect, useState, useRef } from "react"
import {Button} from "@material-tailwind/react";
import {TiMicrophoneOutline} from "react-icons/ti";

const Dictaphone = ({ textDetected }) => {
    const [isClient, setIsClient] = useState(false)
    const [isEnabled, setIsEnabled] = useState(false);

    let recognition;

    useEffect(() => {
        setIsClient(true)
    }, []);

    useEffect(() => {
        if (typeof webkitSpeechRecognition !== 'undefined') {
            recognition = new webkitSpeechRecognition();
            recognition.lang = 'en-US';
            recognition.continuous = true;
            recognition.onresult = function(event) {
                const result = event.results[event.results.length - 1][0];
                const text = result.transcript.trim();

                if (result.confidence > 0 && text !== '') {
                    console.log(text);
                    // TODO
                    recognition.stop();
                }
            }
        }
    });

    const startRecognition = () => {
        if (typeof webkitSpeechRecognition !== 'undefined') {
            setIsEnabled(true);
            recognition.start();
        }
    };

    const stopRecognition = () => {
        if (typeof webkitSpeechRecognition !== 'undefined') {
            setIsEnabled(false);
            recognition.stop();
        }
    }

    const toggle = () => {
        if (isEnabled) {
            stopRecognition();
        } else {
            startRecognition();
        }
    }

    return (
        <>
            {isClient && typeof webkitSpeechRecognition !== 'undefined' ? <Button onClick={toggle} className="bg-gray-200 p-1.5 shadow-none">
                <TiMicrophoneOutline size='1.5rem' className="bg-gray-700"/>
            </Button> : <p></p>}
            {/*{isClient && typeof webkitSpeechRecognition !== 'undefined' ? <button onClick={stopRecognition}>Stop</button> : <p>Recognition not enabled</p>}*/}
        </>
    );
}

export default Dictaphone;