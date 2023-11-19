import MicRecorder from "mic-recorder-to-mp3"
import { useEffect, useState, useRef } from "react"
import axios from "axios"

const Dictaphone = () => {

    let SpeechRecognition = window.speechRecognition || window.webkitSpeechRecognition;
    let recognition = new SpeechRecognition();

    const setupRecording = () => {
        recognition.lang = 'en-US';
        recognition.continuous = true;
        recognition.onresult = function(event) {
            // first is the index => increase when the event gets called
            // important: .confidence > 0 necessary, transcript trimmed is not empty
            let transcript = event.results[0][0].transcript;
            console.log(event.results);
        }
    }

    // Call setupRecording one time on initialization
    useEffect(() => {
        // Initialize speech recognition here
        setupRecording();
    }, []);

    const startRecording = () => {
        recognition.start();
    }


    return (
        <div>
            <button onClick={startRecording}>Start Recording</button>
        </div>
    )
}

export default Dictaphone;