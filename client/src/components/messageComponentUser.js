export default function MessageComponentUser(props) {

    const textToDisplay = props.textToDisplay;

    return(
        <div className="flex justify-end">
            <div className="bg-greenPastel text-white rounded-lg p-2.5 max-w-xs">
                <div className="text-white text-xs font-normal font-['Inter']">{textToDisplay}</div>
            </div>
        </div>
    )
}