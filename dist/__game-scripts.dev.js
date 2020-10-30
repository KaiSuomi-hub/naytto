"use strict";

var VirtualJoystick = pc.createScript("virtualJoystick");
VirtualJoystick.attributes.add("stick", {
  type: "entity"
}), VirtualJoystick.attributes.add("enableEvent", {
  type: "string"
}), VirtualJoystick.attributes.add("moveEvent", {
  type: "string"
}), VirtualJoystick.attributes.add("disableEvent", {
  type: "string"
}), VirtualJoystick.prototype.initialize = function () {
  var t = this.app;
  t.on(this.enableEvent, function (t, i) {
    this.entity.setLocalPosition(t, -i, 0), this.stick.setLocalPosition(t, -i, 0), this.entity.element.enabled = !0, this.stick.element.enabled = !0;
  }, this), t.on(this.moveEvent, function (t, i) {
    this.stick.setLocalPosition(t, -i, 0);
  }, this), t.on(this.disableEvent, function () {
    this.entity.element.enabled = !1, this.stick.element.enabled = !1;
  }, this);
};
var CharacterController = pc.createScript("characterController");
CharacterController.attributes.add("speed", {
  type: "number",
  "default": 5
}), CharacterController.attributes.add("jumpImpulse", {
  type: "number",
  "default": 400
}), CharacterController.prototype.initialize = function () {
  this.groundCheckRay = new pc.Vec3(0, -1.2, 0), this.rayEnd = new pc.Vec3(), this.groundNormal = new pc.Vec3(), this.onGround = !0, this.jumping = !1;
}, CharacterController.prototype.move = function (t) {
  if (this.onGround && !this.jumping) {
    var r = new pc.Vec3(),
        e = t.length();
    e > 0 && (r.cross(this.groundNormal, t).cross(r, this.groundNormal), r.normalize().scale(e * this.speed)), this.entity.rigidbody.linearVelocity = r;
  }
}, CharacterController.prototype.jump = function () {
  this.onGround && !this.jumping && (this.entity.rigidbody.applyImpulse(0, this.jumpImpulse, 0), this.onGround = !1, this.jumping = !0, setTimeout(function () {
    this.jumping = !1;
  }.bind(this), 500));
}, CharacterController.prototype.update = function (t) {
  var r = this.entity.getPosition();
  this.rayEnd.add2(r, this.groundCheckRay);
  var e = this.app.systems.rigidbody.raycastFirst(r, this.rayEnd);
  this.onGround = !!e, e && this.groundNormal.copy(e.normal);
};
var BtnStates = pc.createScript("btnStates");
BtnStates.attributes.add("hoverAsset", {
  type: "asset",
  assetType: "texture"
}), BtnStates.attributes.add("activeAsset", {
  type: "asset",
  assetType: "texture"
}), BtnStates.prototype.initialize = function () {
  this.originalTexture = this.entity.element.textureAsset, this.hovered = !1, this.entity.element.on("mouseenter", this.onEnter, this), this.entity.element.on("mousedown", this.onPress, this), this.entity.element.on("mouseleave", this.onLeave, this), this.entity.element.on("touchstart", this.onPress, this);
}, BtnStates.prototype.onEnter = function (t) {
  this.hovered = !0, t.element.textureAsset = this.hoverAsset;
}, BtnStates.prototype.onLeave = function (t) {
  this.hovered = !1, t.element.textureAsset = this.originalTexture, document.body.style.cursor = "default";
}, BtnStates.prototype.onPress = function (t) {
  t.element.textureAsset = this.activeAsset;
};
var paycart = pc.createScript("paycart");
paycart.attributes.add("entity", {
  type: "entity",
  assetType: "entity"
}), paycart.prototype.initialize = function () {
  this.entity.findByName("Maksa").element.on("mousedown", this.onClick, this);
}, paycart.prototype.onClick = function () {
  window.open("./login-form2.php");
};
var Ui = pc.createScript("ui");
Ui.attributes.add("html", {
  type: "asset",
  assetType: "html"
}), Ui.attributes.add("css", {
  type: "asset",
  assetType: "css"
}), Ui.prototype.initialize = function () {
  var e = document.createElement("div");
  e.id = "ui", e.innerHTML = this.html.resource, document.body.appendChild(e), style = pc.createStyle(this.css.resource), document.head.appendChild(style);
};
var BtnStates2 = pc.createScript("btnStates2");
BtnStates2.attributes.add("hoverAsset", {
  type: "asset",
  assetType: "texture"
}), BtnStates2.attributes.add("activeAsset", {
  type: "asset",
  assetType: "texture"
}), BtnStates2.prototype.initialize = function () {
  this.originalTexture = this.entity.element.textureAsset, this.hovered = !1, this.entity.element.on("mouseenter", this.onEnter, this), this.entity.element.on("mousedown", this.onPress, this), this.entity.element.on("touchstart", this.onPress, this);
}, BtnStates2.prototype.onEnter = function (t) {
  this.hovered = !0, t.element.textureAsset = this.hoverAsset;
}, BtnStates2.prototype.onLeave = function (t) {
  this.hovered = !1, t.element.textureAsset = this.originalTexture, document.body.style.cursor = "default";
}, BtnStates2.prototype.onPress = function (t) {
  t.element.textureAsset = this.activeAsset;
};
var FirstPersonView = pc.createScript("firstPersonView");
FirstPersonView.attributes.add("camera", {
  title: "Camera",
  description: "The camera controlled by this first person view. It should be a child of the entity to which this script is assigned. If no camera is assigned, the script will create one for you.",
  type: "entity"
}), FirstPersonView.prototype.initialize = function () {
  var e = this.app;
  this.camera || (this.camera = this.entity.findByName("Camera"), this.camera || (this.camera = new pc.Entity("FPS Camera"), this.camera.addComponent("camera"))), this.x = new pc.Vec3(), this.z = new pc.Vec3(), this.heading = new pc.Vec3(), this.magnitude = new pc.Vec2(), this.azimuth = 0, this.elevation = 0;
  var t = this.camera.forward.clone();
  t.y = 0, t.normalize(), this.azimuth = Math.atan2(-t.x, -t.z) * (180 / Math.PI), new pc.Mat4().setFromAxisAngle(pc.Vec3.UP, -this.azimuth).transformVector(this.camera.forward, t), this.elevation = Math.atan(t.y, t.z) * (180 / Math.PI), this.forward = 0, this.strafe = 0, this.jump = !1, this.cnt = 0, e.on("firstperson:forward", function (e) {
    this.forward = e;
  }, this), e.on("firstperson:strafe", function (e) {
    this.strafe = e;
  }, this), e.on("firstperson:look", function (e, t) {
    this.azimuth += e, this.elevation += t, this.elevation = pc.math.clamp(this.elevation, -90, 90);
  }, this), e.on("firstperson:jump", function () {
    this.jump = !0;
  }, this);
}, FirstPersonView.prototype.postUpdate = function (e) {
  this.camera.setEulerAngles(this.elevation, this.azimuth, 0), this.z.copy(this.camera.forward), this.z.y = 0, this.z.normalize(), this.x.copy(this.camera.right), this.x.y = 0, this.x.normalize(), this.heading.set(0, 0, 0), 0 !== this.forward && (this.z.scale(this.forward), this.heading.add(this.z)), 0 !== this.strafe && (this.x.scale(this.strafe), this.heading.add(this.x)), this.heading.length() > 1e-4 && (this.magnitude.set(this.forward, this.strafe), this.heading.normalize().scale(this.magnitude.length())), this.jump && (this.entity.script.characterController.jump(), this.jump = !1), this.entity.script.characterController.move(this.heading);
  var t = this.camera.getPosition();
  this.app.fire("cameramove", t);
};
var KeyboardInput = pc.createScript("keyboardInput");

KeyboardInput.prototype.initialize = function () {
  var e = this.app,
      t = function t(_t, i) {
    switch (_t) {
      case 38:
      case 87:
        e.fire("firstperson:forward", i);
        break;

      case 40:
      case 83:
        e.fire("firstperson:forward", -i);
        break;

      case 37:
      case 65:
        e.fire("firstperson:strafe", -i);
        break;

      case 39:
      case 68:
        e.fire("firstperson:strafe", i);
    }
  },
      i = function i(_i) {
    _i.repeat || (t(_i.keyCode, 1), 32 === _i.keyCode && e.fire("firstperson:jump"));
  },
      s = function s(e) {
    t(e.keyCode, 0);
  },
      a = function a() {
    window.addEventListener("keydown", i, !0), window.addEventListener("keyup", s, !0);
  };

  this.on("enable", a), this.on("disable", function () {
    window.addEventListener("keydown", i, !0), window.addEventListener("keyup", s, !0);
  }), a();
};

var MouseInput = pc.createScript("mouseInput");

function applyRadialDeadZone(e, t, i, s) {
  var a = e.length();

  if (a > i) {
    var n = 1 - s - i,
        r = Math.min(1, (a - i) / n) / a;
    t.copy(e).scale(r);
  } else t.set(0, 0);
}

MouseInput.prototype.initialize = function () {
  var e = this.app,
      t = e.graphicsDevice.canvas,
      i = function i(e) {
    document.pointerLockElement !== t && t.requestPointerLock && t.requestPointerLock();
  },
      s = function s(i) {
    if (document.pointerLockElement === t) {
      var s = event.movementX || event.webkitMovementX || event.mozMovementX || 0,
          a = event.movementY || event.webkitMovementY || event.mozMovementY || 0;
      e.fire("firstperson:look", -s / 5, -a / 5);
    }
  },
      a = function a() {
    window.addEventListener("mousedown", i, !1), window.addEventListener("mousemove", s, !1);
  };

  this.on("enable", a), this.on("disable", function () {
    window.removeEventListener("mousedown", i, !1), window.removeEventListener("mousemove", s, !1);
  }), a();
};

var TouchInput = pc.createScript("touchInput");
TouchInput.attributes.add("deadZone", {
  title: "Dead Zone",
  description: "Radial thickness of inner dead zone of the virtual joysticks. This dead zone ensures the virtual joysticks report a value of 0 even if a touch deviates a small amount from the initial touch.",
  type: "number",
  min: 0,
  max: .4,
  "default": .3
}), TouchInput.attributes.add("turnSpeed", {
  title: "Turn Speed",
  description: "Maximum turn speed in degrees per second",
  type: "number",
  "default": 150
}), TouchInput.attributes.add("radius", {
  title: "Radius",
  description: "The radius of the virtual joystick in CSS pixels.",
  type: "number",
  "default": 50
}), TouchInput.attributes.add("doubleTapInterval", {
  title: "Double Tap Interval",
  description: "The time in milliseconds between two taps of the right virtual joystick for a double tap to register. A double tap will trigger a jump.",
  type: "number",
  "default": 300
}), TouchInput.prototype.initialize = function () {
  var e = this.app,
      t = e.graphicsDevice,
      i = t.canvas;
  this.remappedPos = new pc.Vec2(), this.leftStick = {
    identifier: -1,
    center: new pc.Vec2(),
    pos: new pc.Vec2()
  }, this.rightStick = {
    identifier: -1,
    center: new pc.Vec2(),
    pos: new pc.Vec2()
  }, this.lastRightTap = 0;

  var s = function (s) {
    s.preventDefault();

    for (var a = t.width / i.clientWidth, n = t.height / i.clientHeight, r = s.changedTouches, o = 0; o < r.length; o++) {
      var h = r[o];
      if (h.pageX <= i.clientWidth / 2 && -1 === this.leftStick.identifier) this.leftStick.identifier = h.identifier, this.leftStick.center.set(h.pageX, h.pageY), this.leftStick.pos.set(0, 0), e.fire("leftjoystick:enable", h.pageX * a, h.pageY * n);else if (h.pageX > i.clientWidth / 2 && -1 === this.rightStick.identifier) {
        this.rightStick.identifier = h.identifier, this.rightStick.center.set(h.pageX, h.pageY), this.rightStick.pos.set(0, 0), e.fire("rightjoystick:enable", h.pageX * a, h.pageY * n);
        var d = Date.now();
        d - this.lastRightTap < this.doubleTapInterval && e.fire("firstperson:jump"), this.lastRightTap = d;
      }
    }
  }.bind(this),
      a = function (s) {
    s.preventDefault();

    for (var a = t.width / i.clientWidth, n = t.height / i.clientHeight, r = s.changedTouches, o = 0; o < r.length; o++) {
      var h = r[o];
      h.identifier === this.leftStick.identifier ? (this.leftStick.pos.set(h.pageX, h.pageY), this.leftStick.pos.sub(this.leftStick.center), this.leftStick.pos.scale(1 / this.radius), e.fire("leftjoystick:move", h.pageX * a, h.pageY * n)) : h.identifier === this.rightStick.identifier && (this.rightStick.pos.set(h.pageX, h.pageY), this.rightStick.pos.sub(this.rightStick.center), this.rightStick.pos.scale(1 / this.radius), e.fire("rightjoystick:move", h.pageX * a, h.pageY * n));
    }
  }.bind(this),
      n = function (t) {
    t.preventDefault();

    for (var i = t.changedTouches, s = 0; s < i.length; s++) {
      var a = i[s];
      a.identifier === this.leftStick.identifier ? (this.leftStick.identifier = -1, e.fire("firstperson:forward", 0), e.fire("firstperson:strafe", 0), e.fire("leftjoystick:disable")) : a.identifier === this.rightStick.identifier && (this.rightStick.identifier = -1, e.fire("rightjoystick:disable"));
    }
  }.bind(this),
      r = function r() {
    i.addEventListener("touchstart", s, !1), i.addEventListener("touchmove", a, !1), i.addEventListener("touchend", n, !1);
  };

  this.on("enable", r), this.on("disable", function () {
    i.removeEventListener("touchstart", s, !1), i.removeEventListener("touchmove", a, !1), i.removeEventListener("touchend", n, !1);
  }), r();
}, TouchInput.prototype.update = function (e) {
  var t = this.app;

  if (-1 !== this.leftStick.identifier) {
    applyRadialDeadZone(this.leftStick.pos, this.remappedPos, this.deadZone, 0);
    var i = this.remappedPos.x;
    this.lastStrafe !== i && (t.fire("firstperson:strafe", i), this.lastStrafe = i);
    var s = -this.remappedPos.y;
    this.lastForward !== s && (t.fire("firstperson:forward", s), this.lastForward = s);
  }

  if (-1 !== this.rightStick.identifier) {
    applyRadialDeadZone(this.rightStick.pos, this.remappedPos, this.deadZone, 0);
    var a = -this.remappedPos.x * this.turnSpeed * e,
        n = -this.remappedPos.y * this.turnSpeed * e;
    t.fire("firstperson:look", a, n);
  }
};
var GamePadInput = pc.createScript("gamePadInput");
GamePadInput.attributes.add("deadZoneLow", {
  title: "Low Dead Zone",
  description: "Radial thickness of inner dead zone of pad's joysticks. This dead zone ensures that all pads report a value of 0 for each joystick axis when untouched.",
  type: "number",
  min: 0,
  max: .4,
  "default": .1
}), GamePadInput.attributes.add("deadZoneHigh", {
  title: "High Dead Zone",
  description: "Radial thickness of outer dead zone of pad's joysticks. This dead zone ensures that all pads can reach the -1 and 1 limits of each joystick axis.",
  type: "number",
  min: 0,
  max: .4,
  "default": .1
}), GamePadInput.attributes.add("turnSpeed", {
  title: "Turn Speed",
  description: "Maximum turn speed in degrees per second",
  type: "number",
  "default": 90
}), GamePadInput.prototype.initialize = function () {
  this.app;
  this.lastStrafe = 0, this.lastForward = 0, this.lastJump = !1, this.remappedPos = new pc.Vec2(), this.leftStick = {
    center: new pc.Vec2(),
    pos: new pc.Vec2()
  }, this.rightStick = {
    center: new pc.Vec2(),
    pos: new pc.Vec2()
  };

  var e = function e() {
    window.addEventListener("gamepadconnected", function (e) {}), window.addEventListener("gamepaddisconnected", function (e) {});
  };

  this.on("enable", e), this.on("disable", function () {
    window.removeEventListener("gamepadconnected", function (e) {}), window.removeEventListener("gamepaddisconnected", function (e) {});
  }), e();
}, GamePadInput.prototype.update = function (e) {
  for (var t = this.app, i = navigator.getGamepads ? navigator.getGamepads() : [], s = 0; s < i.length; s++) {
    var a = i[s];

    if (a && "standard" === a.mapping && a.axes.length >= 4) {
      this.leftStick.pos.set(a.axes[0], a.axes[1]), applyRadialDeadZone(this.leftStick.pos, this.remappedPos, this.deadZoneLow, this.deadZoneHigh);
      var n = this.remappedPos.x;
      this.lastStrafe !== n && (t.fire("firstperson:strafe", n), this.lastStrafe = n);
      var r = -this.remappedPos.y;
      this.lastForward !== r && (t.fire("firstperson:forward", r), this.lastForward = r), this.rightStick.pos.set(a.axes[2], a.axes[3]), applyRadialDeadZone(this.rightStick.pos, this.remappedPos, this.deadZoneLow, this.deadZoneHigh);
      var o = -this.remappedPos.x * this.turnSpeed * e,
          h = -this.remappedPos.y * this.turnSpeed * e;
      t.fire("firstperson:look", o, h), a.buttons[0].pressed && !this.lastJump && t.fire("firstperson:jump"), this.lastJump = a.buttons[0].pressed;
    }
  }
};
var FirstPersonMovement = pc.createScript("firstPersonMovement");
FirstPersonMovement.attributes.add("camera", {
  type: "entity",
  description: "Optional, assign a camera entity, otherwise one is created"
}), FirstPersonMovement.attributes.add("lookSpeed", {
  type: "number",
  "default": .25,
  description: "Adjusts the sensitivity of looking"
}), FirstPersonMovement.prototype.initialize = function () {
  this.force = new pc.Vec3(), this.eulers = new pc.Vec3(), this.app.mouse.on("mousemove", this._onMouseMove, this), this.entity.collision || console.error("First Person Movement script needs to have a 'collision' component");
}, FirstPersonMovement.prototype.update = function (e) {
  this.camera || this._createCamera();
  this.force, this.app, this.camera.forward, this.camera.right;
  this.camera.setLocalEulerAngles(this.eulers.y, this.eulers.x, 0);
}, FirstPersonMovement.prototype._onMouseMove = function (e) {
  (pc.Mouse.isPointerLocked() || e.buttons[0]) && (this.eulers.x -= this.lookSpeed * e.dx, this.eulers.y -= this.lookSpeed * e.dy);
}, FirstPersonMovement.prototype._createCamera = function () {
  this.camera = new pc.Entity(), this.camera.setName("First Person Camera"), this.camera.addComponent("camera"), this.entity.addChild(this.camera), this.camera.translateLocal(0, .5, 0);
};
var buy1 = pc.createScript("buy1");
buy1.attributes.add("entity", {
  type: "entity",
  assetType: "entity"
}), buy1.prototype.initialize = function () {
  this.entity.findByName("buy1").element.on("mousedown", this.onClick, this);
}, buy1.prototype.onClick = function () {
  document.cookie = "tilattuteos1=" + {
    id: "1",
    enimi: "enimi",
    snimi: "snimi",
    osoite: "osoite",
    email: "email",
    ohjeita: "ohjeita",
    teos: "teos",
    tmaara: "tmaara",
    puhelin: "puhelin"
  };
};
var buy2 = pc.createScript("buy2");
buy2.attributes.add("entity", {
  type: "entity",
  assetType: "entity"
}), buy2.prototype.initialize = function () {
  this.entity.findByName("buy2").element.on("mousedown", this.onClick, this);
}, buy2.prototype.onClick = function () {
  document.cookie = "tilattuteos2=" + {
    id: "2",
    enimi: "enimi",
    snimi: "snimi",
    osoite: "osoite",
    email: "email",
    ohjeita: "ohjeita",
    teos: "teos",
    tmaara: "tmaara",
    puhelin: "puhelin"
  };
};
var buy3 = pc.createScript("buy3");
buy3.attributes.add("entity", {
  type: "entity",
  assetType: "entity"
}), buy3.prototype.initialize = function () {
  this.entity.findByName("buy3").element.on("mousedown", this.onClick, this);
}, buy3.prototype.onClick = function () {
  document.cookie = "tilattuteos3=" + {
    id: "3",
    enimi: "enimi",
    snimi: "snimi",
    osoite: "osoite",
    email: "email",
    ohjeita: "ohjeita",
    teos: "teos",
    tmaara: "tmaara",
    puhelin: "puhelin"
  };
};