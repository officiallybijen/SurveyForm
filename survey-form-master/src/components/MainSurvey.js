import { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import Navbar from "../components/Navbar";

export const surveyResults = [];

function MainSurvey() {
  const [allForm, setAllForm] = useState();

  useEffect(() => {
    fetch("http://127.0.0.1:8000/api/allform", {
      method: "GET",
      headers: { "Content-Type": "application/json" },
    })
      .then((res) => {
        return res.json();
      })
      .then((data) => {
        setAllForm(data);
      });
  }, []);

  return (
    <div>
    <Navbar />
      {allForm &&
        allForm.map((item) => {
          let id=item.id
          id=id.toString()
          return (
            <div className="text-start ms-5" key={item.id}>
              <Link className="fs-1 text-decoration-none" to={id} >
                {item.id}. <span>{item.title}</span>
              </Link>
            </div>
          );
        })}
    </div>
  );
}
export default MainSurvey;
